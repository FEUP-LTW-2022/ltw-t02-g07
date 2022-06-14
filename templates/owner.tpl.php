<?php declare(strict_types = 1); ?>

<?php function drawProfileForm(User $User) { ?>
<h2>Profile</h2>
<form action="actions/action_edit_profile.php" method="post" class="profile">

  <label for="name">Name:</label>
  <input id="name" type="text" name="name" value="<?=$User->name?>">
  
  <label for="email">Email:</label>
  <input id="email" type="email" name="email" value="<?=$User->email?>">   

  <label for="phone_number">Phone Number:</label>
  <input id="phone_number" type="tel" name="phone_number" value="<?=$User->phone?>">  

  <label for="address">Address:</label>
  <input id="address" type="text" name="address" value="<?=$User->address?>">  
  
  <button type="submit">Save</button>
</form>

<?php } ?>

<?php function drawOwnerStatistics(array $restaurants) { ?>
        <div class="row">
          <div class="column">
            <table name="restaurantsTable" id="restaurantsTable" class="myTable">
              <caption>Restaurants</caption>
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Picture</th>
                  <th>Address</th>
                  <th>Category</th>
                </tr>
              </thead>
              <tbody id="restaurantsTableBody">
              <?php
              if(count($restaurants) > 0){
                foreach($restaurants as $restaurant) {
                  echo "<tr contenteditable=true data-id=" . $restaurant["id"] . ">
                          <td>" . $restaurant["name"]. "</td>
                          <td>" . $restaurant["picture"] . "</td>
                          <td>" . $restaurant["address"]. "</td>
                          <td>" . $restaurant["category"] ."</td>
                        </tr>";
                }
              } else { echo "0 results"; }
              ?>
              </tbody>
            </table>
            <form autocomplete = "off" id="addForm">
            <button id="deleteRestaurant" onclick = "deleteRestaurant()">Delete highlighted restaurant</button>
            <form id="addForm">
              <input type="text" name="name" id="name" placeholder="name*">
              <input type="text" name="picture" id="picture" placeholder = "picture">
              <input type="text" name="address" id="address" placeholder ="address*">
              <input type="text" name="category" id="category" placeholder ="category*">
              <button id="submit">Add restaurant</button>
            </form>
          </div>
          <div class="column">
            <div class="tab">
              <button class="tablinks" onclick="openTab(event, 'dishesTab')" id="defaultOpen">Dishes</button>
              <button class="tablinks" onclick="openTab(event, 'reviewsTab')">Reviews</button>
              <button class="tablinks" onclick="openTab(event, 'ordersTab')">Orders</button>
            </div>

            <div id="dishesTab" class="tabcontent">
              <p> Click on a restaurant to show info </p>
            </div>

            <div id="reviewsTab" class="tabcontent">
            <p> Click on a restaurant to show info </p>
            </div>

            <div id="ordersTab" class="tabcontent">
            <p> Click on a restaurant to show info </p>
            </div>
            <form id="addDishForm" class="dishForm">
              <input type="text" name="nameDish" id="nameDish" placeholder="name*">
              <input type="text" name="descriptionDish" id="descriptionDish" placeholder = "description*">
              <input type="number" name="priceDish" id="priceDish" placeholder ="price*">
              <input type="text" name="categoryDish" id="categoryDish" placeholder ="category*">
              <input type="text" name="pictureDish" id="pictureDish" placeholder ="picture">
              <input type="number" name="promotionDish" id="promotionDish" placeholder ="promotion">
            </form>
            <button id="submitDish">Add dish</button>
          </div>
        </div>
        <script>



          //make contenteditables on lose focus save to database
          $('body').on('focus', '[contenteditable]', function() {
              const $this = $(this);
              $this.data('before', $this.html());
            }).on('blur paste', '[contenteditable]', function() {
              const $this = $(this);
              if ($this.data('before') !== $this.html()) {
                  $this.data('before', $this.html());
                  //$this.trigger('change');
                  var dat = [];
                  var cells = this.getElementsByTagName("td");
                  var name = this.parentElement.parentElement.getAttribute("name");
                  var id = this.dataset.id;
                  if(cells.length === 0){
                    cells = this.parentElement.getElementsByTagName("td");
                    name = this.parentElement.parentElement.parentElement.getAttribute("name")
                    id = this.parentElement.dataset.id;
                  }
                  for (var i = 0; i < cells.length; i++) {
                    dat.push(cells[i].textContent);
                  }
                  $.post(
                    "handlers/updateTables.php",
                    {id:id,type:name,
                    data:dat},
                    function(data){
                      console.log(data);
                    }
                  )

              }
          });

          function deleteRestaurant(){
            var table = document.getElementById('restaurantsTableBody');
            var highlighted = table.getElementsByClassName('active-row');
            $.post("handlers/removeRestaurant.php",
                  {id:highlighted[0].dataset.id},
                  function(data){
                    highlighted[0].remove();
                  })
          }
          //adding onclick event addRestaurant form
          $(document).ready(function(){
            $("#submit").click(function() {
            var name = $("#name").val();
            var picture = $("#picture").val();
            var address = $("#address").val();
            var category = $("#category").val();

            if(name==''||address==''||category=='') {
              alert("Please fill all mandatory fields");
              return false;
            }
            $.ajax({
              type: "POST",
              url: "handlers/addRestaurant.php",
              data: {
                name: name,
                picture: picture,
                address: address,
                category: category
              },
              cache: false,
              success: function(data) {
                var table = document.getElementById('restaurantsTableBody');
                var template =`<tr contenteditable="true" data-id=${data}>
                                <td>${name}</td> 
                                <td>${picture}</td>
                                <td>${address}</td>
                                <td>${category}</td>
                              </tr>`;

                table.innerHTML += template;
              },
              error: function(xhr, status, error) {
                console.error(xhr);
              }
              });
            });
          });
          //adding onclick even to addDish form
          $(document).ready(function(){
            $("#submitDish").click(function() {
            var table = document.getElementById('restaurantsTable');
            console.log(table);
            var highlighted = table.getElementsByClassName('active-row');
            var id = highlighted[0].dataset.id;
            var name = $("#nameDish").val();
            var description = $("#descriptionDish").val();
            var price = $("#priceDish").val();
            var category = $("#categoryDish").val();
            var picture = $("#pictureDish").val();
            var promotion = $("#promotionDish").val();
            if(name==''||description ==''||category==''||price=='') {
              alert("Please fill all mandatory fields");
              return false;
            }
            $.ajax({
              type: "POST",
              url: "handlers/addDish.php",
              data: {
                restaurantId: id,
                name: name,
                picture: picture,
                price: price,
                category: category,
                promotion: promotion,
                description: description
              },
              success: function(data) {
                var table = document.getElementById('dishTable');
                var template =`<tr contenteditable="true" data-id=${data}>
                                <td>${name}</td> 
                                <td>${description}</td>
                                <td>${price}</td>
                                <td>${category}</td>
                                <td>${picture}</td>
                                <td>${promotion}</td>
                              </tr>`;

                table.innerHTML += template;
              },
              error: function(xhr, status, error) {
                console.error(xhr);
              }
              });
            });
          });
          //Order state change
          function stateChange(id){
            var select = document.getElementById(id);
            var orderId = select.parentElement.parentElement.dataset.id;
            $.ajax({
                type:"POST",
                url:'handlers/changeOrderState.php',
                data:{id:orderId,state:select.value},
                success: function(data){
                  console.log("change success");
                }
              });

          }
          //highlighting the selected row
          function add_highlighting(){
            $(function() {
            $('td').click(function() {
                $('tr').removeClass('active-row');
                $(this).parent().addClass('active-row'); 
                $.ajax({
                  type:"POST",
                  url:'handlers/fetchRestaurantDishes.php',
                  data:{id:this.parentElement.dataset.id},
                  dataType: "html",
                  success: function(data){
                    $("#dishesTab").html(data); 
                  }
                });
                $.ajax({
                  type:"POST",
                  url:'handlers/fetchRestaurantReviews.php',
                  data:{id:this.parentElement.dataset.id},
                  dataType: "html",
                  success: function(data){
                    $("#reviewsTab").html(data); 
                  }
                });
                $.ajax({
                  type:"POST",
                  url:'handlers/fetchRestaurantOrders.php',
                  data:{id:this.parentElement.dataset.id},
                  dataType: "html",
                  success: function(data){
                    $("#ordersTab").html(data); 
                  }
                });

                });
            });
          }
          add_highlighting();

          //switching tabs
          function openTab(evt, tabName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
              tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
              tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(tabName).style.display = "block";
            evt.currentTarget.className += " active";
            if(tabName === 'dishesTab'){
              document.getElementById("addDishForm").style.visibility="visible";
              document.getElementById("submitDish").style.visibility="visible";
            }else{
              document.getElementById("addDishForm").style.visibility="hidden";
              document.getElementById("submitDish").style.visibility="hidden";
            }
            }

          // Get the element with id="defaultOpen" and click on it
            document.getElementById("defaultOpen").click();
        </script>
<?php } ?>