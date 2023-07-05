@extends('frontend.master')
@section('content')
    @include('frontend.components.hero_section')
    @include('frontend.components.about_section')
    <div class="mt-5">
        @include('frontend.components.loader')
    </div>
@endsection
@section('script')
    <script>
        (async () => {
            try {
                //show loader
                document.getElementById('loader').classList.remove('d-none')

                //Hero data load
                const heroURL = "{{ url('/heroData') }}";
                const heroResponse = await axios.get(heroURL);
                const heroData = heroResponse.data;
                document.getElementById('hero_content').classList.remove('d-none')
                document.getElementById("keyLine").innerText = heroData["key_line"]
                    .split(",")
                    .join(" - ");
                document.getElementById("short_title").innerText =
                    heroData["short_title"];
                document.getElementById("title").innerText = heroData["title"];
                document.getElementById(
                    "image"
                ).src = `{{ url('upload/about/${heroData.image}') }}`;


                //About Data load 
                const aboutURL = "{{ url('/aboutData') }}";
                const aboutResponse = await axios.get(aboutURL);
                document.getElementById('about_title').innerText = aboutResponse.data.title;
                document.getElementById('about_details').innerText = aboutResponse.data.details;

                const socialURL = "{{ url('/socialData') }}";
                const socialResponse = await axios.get(socialURL);
                document.getElementById('twitter_link').href = socialResponse.data.twitter_link;
                document.getElementById('linkedin_link').href = socialResponse.data.linkedin_link;
                document.getElementById('github_link').href = socialResponse.data.github_link;
                document.getElementById('about_content').classList.remove('d-none')

                //hide loader
                document.getElementById('loader').classList.add('d-none')
            } catch (error) {
                console.log(error);
            }
        })();
    </script>
@endsection
