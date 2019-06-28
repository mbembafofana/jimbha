<?php session_start(); ?>

    <!DOCTYPE html>
    <html class="h-100" lang="fr">
<head>
    <meta charset="utf-8">
    <meta HTTP-EQUIV="pragma" content="no-cache">
    <meta name="viewport" content="width-device-width, init-scale=1">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery3.4.0.js"></script>
    <script src="js/onclick.js"></script>
    <script src="menu4.js"></script>
    <title>Contact</title>

</head>
<body class="d-flex flex-column h-100">
    <header>
        <?php require_once('require_once/db.php') ?>
        <?php require_once("require_once/menu.php") ?>
    </header>

        <div class="container-fluid">
            <div class="row">
                <?php require_once("require_once/menu_left.php") ?>
                <div id="sideButton" class="col-md-3">
                    <button id="hamburger"><img src="images/burger.png" style="width: 40px;"></i></button>
                </div> <!--Fin div id="sideButton"-->
                <div id="contact_content" class="d-flex flex-column col-9">
                    <img src="images/contact.jpeg">
                    <h1>Contacter un administrateur</h1>
                    <p>Contactez notre service technique disponible 7 jours sur 7 et 24h sur 24 !</p>
                </div> <!--Fin div id="contact_content"-->
            </div> <!--Fin div class="row"-->

            <div class="row">
                <div id="contact_form" class="col-md-6">
                        <form id="contact-form" name="contact-form" action="contact_mail.php" method="POST">
                            <div class="form-group">
                                <label for="name" class="">Votre nom</label>
                                <input type="text" id="name" name="name" class="form-control">
                            </div> <!--Fin div class="form-group"-->

                            <div class="form-group">
                                <label for="email" class="">Votre email</label>
                                <input type="text" id="email" name="email" class="form-control">                                        
                            </div> <!--Fin div class="form-group"-->

                            <div class="form-group">
                                <label for="subject" class="">Sujet du message</label>
                                <input type="text" id="subject" name="subject" class="form-control">                                        
                            </div> <!--Fin div class="form-group"-->

                            <div class="form-group">
                                <label for="message">Votre message</label>
                                <textarea type="text" id="message" name="message" rows="2" class="form-control md-textarea"></textarea>
                            </div> <!--Fin div class="form-group"-->
                                <button class="btn btn-primary" style="color: white; background-color: rgb(33, 67, 139);" onclick="document.getElementById('contact-form').submit();">Envoyer</button>            
                        </form>
                </div> <!--Fin div id="contact_form"-->

                <div id="localisation" class="col-md-6">
                        <ul>
                            <li>
                                <p><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2624.7993847176735!2d2.341408266285395!3d48.8620357970082!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66e23c409ec1f%3A0xa893a28429681799!2s7+Rue+du+Louvre%2C+75001+Paris!5e0!3m2!1sfr!2sfr!4v1556031337353!5m2!1sfr!2sfr" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe></p>
                            </li>

                            <li>
                                <i class="fas fa-phone mt-4 fa-2x"></i><a href="tel: +33123456789"> 01 23 45 67 89</a>
                            </li>

                            <li>
                                <i class="fas fa-envelope mt-4 fa-2x"></i><a href="mailto:contact@jimbha.com"> contact@jimbha.com</a>
                            </li>
                        </ul>
                </div> <!--Fin div id="localisation"-->
            </div> <!--Fin div class="row"-->
        </div> <!--Fin class="container-fluid"-->



</div>
    <footer class="footer mt-auto py-3">
        <div class="container-fluid">
            <div class="row">
                <?php require_once('require_once/footer.php');?>
            </div> <!--Fin div class="row"-->
        </div> <!--Fin class="container-fluid"-->
    </footer>
</body>
</html>