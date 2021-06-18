<!-------------------Contact----------------->
<section id="contact">
    <div class="container ">
        <h1>{{ __('Contact') }}</h1>
        <div class="row ">
            <div class="col-md-6 ">
                <!-- Success message -->
                    <div class="alert d-none" id="contact-section">
                        <h5 id="messageResponse"></h5>
                    </div>
                <form class="contact-form" id="contact-message-form">
                <!-- CROSS Site Request Forgery Protection -->
                @csrf
                    <div class="form-group ">
                        <input type="text " name="name" id="name" class="form-control contact-control {{ $errors->has('name') ? 'error' : '' }}" placeholder="{{ __('Name') }}" required="required">
                        <!-- Error -->
                        @if ($errors->has('name'))
                        <div class="error">
                            {{ $errors->first('name') }}
                        </div>
                        @endif
                    </div>
                    <div class="form-group ">
                        <input type="email " name="email" id="email" class="form-control contact-control {{ $errors->has('email') ? 'error' : '' }}" placeholder="{{ __('Email') }}" required="required">
                        @if ($errors->has('email'))
                        <div class="error">
                            {{ $errors->first('email') }}
                        </div>
                        @endif
                    </div>
                    <div class="form-group ">
                        <input type="tel" name="phone" id="phone" class="form-control contact-control {{ $errors->has('phone') ? 'error' : '' }}" placeholder="{{ __('Phone') }}" required="required">
                        @if ($errors->has('phone'))
                        <div class="error">
                            {{ $errors->first('phone') }}
                        </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control contact-control {{ $errors->has('subject') ? 'error' : '' }}" name="subject" id="subject" placeholder="{{ __('Subject') }}">
                        @if ($errors->has('subject'))
                        <div class="error">
                            {{ $errors->first('subject') }}
                        </div>
                        @endif
                    </div>
                    <div class="form-group ">
                        <textarea class="form-control contact-control {{ $errors->has('message') ? 'error' : '' }}" name="message" id="message" rows="4 " placeholder="{{ __('Message') }}" required="required"></textarea>
                        @if ($errors->has('message'))
                        <div class="error">
                            {{ $errors->first('message') }}
                        </div>
                        @endif
                    </div>
                    <button type="button" name="contact-submit" class="btn btn-primary" data-toggle="modal" data-target="#errorsystem" id="contact-message-submit">{{ __('Send message') }}</button>
                </form>
            </div>
            <div class="col-md-6 contact-info ">
                <div class="follow "><b>{{ __('Address') }}:</b> <a href="https://www.google.ro/maps/place/Mirasoil/@46.3684154,23.6983053,17z/data=!3m1!4b1!4m5!3m4!1s0x47495b1cddbd8c7f:0xc5717c5adb87f1ba!8m2!3d46.3684154!4d23.700494"> <i class="fas fa-map-marker-alt"></i>Str. Principală, Nr. 130, Miraslău, Alba</a></div>
                <div class="follow "><b>{{ __('Phone') }}: </b><a href="tel:+40754916986"><i class="fas fa-phone-alt"> </i>+40754916986</a></div>
                <div class="follow "><b>{{ __('Email') }}: </b><a href="mailto:contact@mirasoil.ro"><i class="fas fa-envelope"> </i>contact@mirasoil.ro</a></div>
                <div class="follow "><label><b>{{ __('Social') }}: </b> </label>
                    <a href="https://www.facebook.com/mirasoil16/" class="social-icons"><i class="fab fa-facebook-square"></i></a>
                    <a href="https://www.instagram.com/mirasoil16/" class="social-icons"><i class="fab fa-instagram "></i></a>
                    <a href="https://www.instagram.com/mirasoil16/" class="social-icons"><i class="fab fa-google-plus-g"></i></a>

                </div>
            </div>
        </div>
    </div>
</section>
<script>
// Send contact message
$(document).on("click", "#contact-message-submit", function() { 
    var user_id = $('#userId').val();
    var url = "{{ route('contact.store', app()->getLocale()) }}";

    formElement = document.getElementById("contact-message-form")
    formObject = new FormData(formElement)

    dataObject = {}
    formObject.forEach(function(valoare,cheie) {
        dataObject[cheie]=valoare
        })
    finalData = JSON.stringify(dataObject)

    axios
    .post(url, finalData, {
        headers: {"Content-Type": "application/json"}
        }) 
        .then(response => {
            if(response.status == 200)
            {
                $("#contact-section").removeClass("d-none"); 
                $("#contact-section").addClass("alert-success"); 
                $("#messageResponse").html("{{ __('We have received your message and would like to thank you for writing to us.') }}");  
                $('#contact-message-form').trigger("reset");
            }
            else{
                alert("Internal Server Error");
            }
        })
    });
</script>