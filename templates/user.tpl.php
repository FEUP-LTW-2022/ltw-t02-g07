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
        <input id="email" type="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
              value="<?=$User->email?>">   

        <label for="phone_number">Phone Number:</label>
        <input id="phone_number" type="tel" name="phone_number" 
              pattern = "^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$"
              value="<?=$User->phone?>">  

        <label for="address">Address:</label>
        <input id="address" type="text" name="address" value="<?=$User->address?>">  

        <label for="password1">New password:</label>
        <input id="password1" type="password" name="password1">  

        <label for="password2">Old pasword:</label>
        <input id="password2" type="password" name="password2">  
        
        <button type="submit">Save</button>
      </form>
    </div>
  </div>
  <div class="fix"></div>

<?php } ?>