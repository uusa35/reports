@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="row-fluid">
                    <div class="span8">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3478.8968391908716!2d47.89863101509818!3d29.31470158215367!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3fcf90228bae07d1%3A0x25cf4f1c7a576007!2z2YXYsdmD2LIg2KfZhNiq2K_YsdmK2Kgg2KfZhNiq2K7Ytdi12Yog2YTZgti32KfYuSDYp9mE2YXYsdmI2LE!5e0!3m2!1sen!2skw!4v1632467718056!5m2!1sen!2skw"
                            width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <h2>General Department of Traffic</h2>
                            <address>
                                <strong>Kuwait - General Department of Traffic - Al-Shwaich</strong><br>
                                Mob : +965 66888123<br>
                                salem_89@hotmail.com<br>
                            </address>
                        </div>
                        <div class="col-8">
                            <!-- contact form -->
                            <div class="col-md-6 wow animated fadeInRight" data-wow-delay=".2s">
                                <form class="shake" role="form" method="post" id="contactForm" name="contact-form"
                                      data-toggle="validator">
                                    <!-- Name -->
                                    <div class="form-group label-floating">
                                        <label class="control-label" for="name">Name</label>
                                        <input class="form-control" id="name" type="text" name="name" required
                                               data-error="Please enter your name">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <!-- Civil ID No. -->
                                    <div class="form-group label-floating">
                                        <label class="control-label" for="name">Civil ID No.</label>
                                        <input class="form-control" id="name" type="text" name="civil_id" required
                                               data-error="Please enter your name">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <!-- email -->
                                    <div class="form-group label-floating">
                                        <label class="control-label" for="email">Email</label>
                                        <input class="form-control" id="email" type="email" name="email" required
                                               data-error="Please enter your Email">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <!-- Subject -->
                                    <div class="form-group label-floating">
                                        <label class="control-label">Subject</label>
                                        <input class="form-control" id="msg_subject" type="text" name="subject" required
                                               data-error="Please enter your message subject">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <!-- Message -->
                                    <div class="form-group label-floating">
                                        <label for="message" class="control-label">Message</label>
                                        <textarea class="form-control" rows="3" id="message" name="message" required
                                                  data-error="Write your message"></textarea>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <!-- Form Submit -->
                                    <div class="form-submit mt-5">
                                        <button class="btn btn-primary" type="submit" id="form-submit"><i
                                                class="material-icons mdi mdi-message-outline"></i> Send Message
                                        </button>
                                        <div id="msgSubmit" class="h3 text-center hidden"></div>
                                        <div class="clearfix"></div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
