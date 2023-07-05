<?php
include('setting.php');
include('public/includes/header.php');
include('public/includes/navbar.php');

?>

<?php
if (isset($_GET['register'])) {
    echo '<p class="alert alert-success col-sm-6 text-center mx-auto mt-3" >You have successfully registered.</p>';
}
if (isset($_GET['logged_out'])) {
    echo '<p class="alert alert-success col-sm-6 text-center mx-auto mt-3">You have logged out successfully!!.</p>';
}

?>

<div class="py-5">
    <div class="container">

        <div class="para-1">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corrupti, beatae maiores quibusdam dolor quis blanditiis ut maxime adipisci voluptatem soluta aperiam error velit eaque, praesentium ipsam tempora! Quaerat libero ea distinctio quidem aliquid esse est eius consequatur dolores dolorem tenetur, iste delectus corrupti similique animi illum! Quasi laudantium magnam repudiandae exercitationem, libero ipsam laboriosam delectus quibusdam tempore, mollitia rem eum? Accusamus laudantium dolores sed quas repudiandae magni sint architecto laborum accusantium dolore maiores eius explicabo delectus, animi eveniet iure facilis earum. Aut dolores, quaerat corporis, odit impedit distinctio non, aliquam libero numquam iure quos ut iste? Ipsam, aliquid vel cumque possimus consectetur optio eligendi quia enim aliquam blanditiis minus officiis officia quisquam commodi, laborum sapiente maxime unde. Iusto quo unde at soluta praesentium repudiandae. Hic ipsa voluptas quibusdam, dolorum soluta magnam accusamus? Animi sit consequuntur ratione ea vel at nisi pariatur tempora, maiores, accusamus quae expedita delectus, dolorem rerum repellendus!</p>
        </div>

        <?php
        if (isset($row['username'])) {
            // User is logged in, display para-2
            echo '<div class="para-2">';
            echo '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut quae temporibus eum consequatur ratione quidem consequuntur, ipsum incidunt fugit sequi eaque soluta iste minima provident laborum quam dolore aspernatur corporis nesciunt. Rerum nobis ea iure dolorum officiis facere voluptas ut! Vero non fugit voluptatum repudiandae maiores nihil esse nobis est accusantium tempore eum maxime facilis numquam cupiditate quos et voluptates optio, velit sunt. Dicta aliquid ullam enim eaque totam. Iusto nostrum obcaecati, enim, soluta pariatur quae aliquid aperiam labore sint earum ducimus molestias iure accusamus. Quae, dicta dolores repellendus tenetur sed laudantium provident asperiores deserunt earum dolorem maxime fugiat, porro enim distinctio ad necessitatibus quaerat incidunt perferendis ratione itaque vero consequatur illo eaque? Dicta nobis, debitis totam temporibus tenetur error eveniet pariatur enim? Atque, facere rem aliquam laboriosam aspernatur sed quo mollitia tempora totam explicabo, sint dolorem temporibus consequatur ea. Nostrum voluptas vitae mollitia error praesentium delectus voluptatum eaque at!</p>';
            echo '</div>';
        }
        ?>

        <?php
        if (!isset($row['username'])) {
            echo '  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#popupModal">
           Continue Reading</button>';
        }
        ?>


        <!-- Modal -->
        <div class="modal fade" id="popupModal" tabindex="-1" aria-labelledby="popupModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <p class="modal-title pb-2 pt-2 " id="popupModalLabel">Want to read more please Login</p>
                        <a href="login.php"><button type="submit" class="btn btn-primary btn-block mx-3" name="submit_form">Login</button></a>

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p class="pb-lg-2 text-center">Don't have an account? <a href="register.php" style="color: #393f81;">Register here</a></p>
                    </div>

                </div>
            </div>
        </div>




    </div>
</div>

<?php
include('public/includes/footer.php');
?>