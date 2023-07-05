@extends('frontend.master')
@section('content')
    @include('frontend.components.contact_form')
@endsection
@section('script')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        try {
            const contactForm = document.getElementById("contactForm");
            contactForm.addEventListener("submit", async (e) => {
                e.preventDefault();
                const fullName = document.getElementById("fullName").value;
                const email = document.getElementById("email").value;
                const phone = document.getElementById("phone").value;
                const message = document.getElementById("message").value;

                if (fullName.length === 0) {
                    toastr.info("Full name is required");
                } else if (email.length === 0) {
                    toastr.info("Email is required");
                } else if (phone.length === 0) {
                    toastr.info("Phone Number is required");
                } else if (message.length === 0) {
                    toastr.info("Message is required");
                } else {
                    const formData = {
                        full_name: fullName,
                        email: email,
                        phone: phone,
                        message: message,
                    }
                    const URL = "{{ url('/storeContact') }}";
                    const result = await axios.post(URL, formData);
                    if (result.status == 201 && result.data.status == 'success') {
                        toastr.success("Your form has been submitted successfully.");
                        contactForm.reset();
                    } else {
                        toastr.warning("Something went wrong");
                    }
                }
            });
        } catch (error) {
            console.log(error);
        }
    </script>
@endsection
