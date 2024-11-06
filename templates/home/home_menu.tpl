<!DOCTYPE html>
<head>
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
   <nav class="container">
      <ul>
         <li class="logo"><img src="assets/images/logo/Weed_Valley_Logo.png" alt="Weed Valley Logo"></li>
         <li class="items"><a href="index.php">{home}</a></li>
         <li class="items"><a href="#">{rules}</a></li>
		 <li class="items"><a href="register.php">{register}</a></li>
         <li class="items"><a href="https://discord.com/">{contact}</a></li>
         <li class="items"><a href="changelog.php">{changelog}</a></li>
         <li class="btn"><a href="#"><i class="fas fa-bars"></i></a></li>
		 <li class="language-menu">
            <form method="get" action="index.php" class="language-form">
                <select name="lang" onchange="this.form.submit()" class="language-selector">
                    <option value="fr" {selected_fr}>Français</option>
                    <option value="en" {selected_en}>English</option>
                    <option value="es" {selected_es}>Español</option>
                    <option value="de" {selected_de}>Deutsch</option>
                    <option value="it" {selected_it}>Italiano</option>
                    <option value="nl" {selected_nl}>Nederlands</option>
                    <option value="pt" {selected_pt}>Português</option>
                </select>
            </form>
         </li>
      </ul>
   </nav>
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <script>
      $(document).ready(function(){
  $('.btn').click(function(){
    $('.items').toggleClass("show");
    $('ul li').toggleClass("hide");
  });
});
   </script>
</body>
</html>


