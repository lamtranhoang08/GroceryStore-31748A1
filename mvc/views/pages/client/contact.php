<!-- body -->

<div class="grid wide">
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= _WEB_ROOT . '/home' ?>">Home</a></li>
            <li class="breadcrumb-item active"><?= $data['title'] ?></li>
        </ol>
    </nav>
    <div class="row p-3 pt-0">

        <div class="contact-form col-lg-6" data-aos="fade-right">
            <div class="contact-heading">
                <h3>
                    WHERE ALL YOUR QUESTIONS ARE ANSWERED?

                </h3>

                <div class="time_work">
                    <div class="contact-item">
                        <b>Hotline:</b>
                        <a class="fone" href="tel:0123456789" title="0123456789">0123456789</a>
                    </div>
                    <div class="contact-item">
                        <b>Email:</b>
                        <a href="mailto:lamtiensinh2301@gmail,com" title="lamtiensinh2301@gmail,com">admin@gmail.com</a>
                    </div>

                </div>
            </div>
            <h3 class="contact-title font-weight-bold">CONTACT US!</h3>
            <p>We look forward to hearing from you. Please contact us and one of our members will contact you as soon as possible. We love receiving your emails every day.</p>
            <form method="post" class="bg-form-control p-3 border-radius-main border-main">
                <div class="row contact-group">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <input placeholder="Full name" type="text" class=" form-control  form-control-lg" required="" value="" name="ten">
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <input type="text" placeholder="Phone" name="so_dt" class=" form-control form-control-lg" required="">
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <input placeholder="Email" type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required="" id="email1" class=" form-control form-control-lg" value="" name="email">
                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <textarea placeholder="Content" name="noi_dung" id="comment" class=" form-control form-control-lg" rows="2" required=""></textarea>
                        <button type="submit" class="btn-main my-4">Send information</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="map user-select-none col-lg-6 " data-aos="fade-left">
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d105875.43306482863!2d151.0576614!3d-33.9769321!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6b12ae265bb4a143%3A0x16e224b2bd8fa957!2zxJDhuqFpIGjhu41jIEvhu7kgdGh14bqtdCBTeWRuZXk!5e0!3m2!1svi!2s!4v1712382040801!5m2!1svi!2s" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>

</div>