<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
        <script src="bootstrap/js/jquery-1.11.3.js"></script>
        <script src="bootstrap/js/jquery-2.1.4.js"></script>

        <script src="bootstrap/js/bootstrap.js"></script>
        <script src="js/flipclock.min.js"></script>
        <script src="js/notificationcollector.js"></script>

    
        <script>
            $(document).ready(function(){
                $('.navbar .dropdown').hover(function(){
                    $(this).find('.dropdown-menu').first().stop(true, true).slideDown();
                }, function(){
                    $(this).find('.dropdown-menu').first().stop(true, true).slideUp();
                })
            })
            
        </script>
        <script>
            // Closes the sidebar menu
            $("#menu-close").click(function(e) {
                e.preventDefault();
                $("#sidebar-wrapper").toggleClass("active");
                //$("#slidebar-wrapper").toggleClass("active");
            });

            // Opens the sidebar menu
            $("#menu-toggleDt").click(function(e) {
                e.preventDefault();
                $("#slidebar-wrapper").toggleClass("active");
            });
            $("#menu-toggleMb").click(function(e) {
                e.preventDefault();
                $("#sidebar-wrapper").toggleClass("active");
            });

        </script>