<?php declare(strict_types = 1); ?>

<?php function drawProfileForm(User $User) { ?>

  <div class="blueBg">
    <div class="informBox">
      <h2>Profile</h2>
      <form action="actions/action_edit_profile.php" method="post" class="profile">
      <input name = "csrf" id="csrf" type = "hidden" value = "<?=$_SESSION['csrf']?>">
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
    </div>
  </div>
  <div class="fix"></div>

<?php } ?>