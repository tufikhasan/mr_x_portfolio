@extends('frontend.master')
@section('content')
    <!-- Page Content-->
    <div class="container px-5 my-5">
        <div class="text-center mb-5">
            <h1 class="display-5 fw-bolder mb-0"><span class="text-gradient d-inline">Resume</span></h1>
        </div>
        <div class="row gx-5 justify-content-center">
            <div class="col-lg-11 col-xl-9 col-xxl-8">
                <!-- Experience Section-->
                @include('frontend.components.experience')
                <!-- Education Section-->
                @include('frontend.components.education')
                <!-- Divider-->
                <div class="pb-5"></div>
                <section>
                    <!-- Skills Section-->
                    @include('frontend.components.skill')
                    <!-- Languages Section-->
                    @include('frontend.components.language')
                </section>
            </div>
        </div>
        <div class="row gx-5 justify-content-center">
            <div class="col-lg-11 col-xl-9 col-xxl-8">
                @include('frontend.components.loader')
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        (async () => {
            try {
                //show loader
                document.getElementById('loader').classList.remove('d-none');

                //resume pdf file
                const resumeURL = "{{ url('/resumeData') }}";
                const resumeResponse = await axios.get(resumeURL);
                document.getElementById('resume_download_btn').href = resumeResponse.data.download_link;

                //experience data loop
                const experienceURL = "{{ url('/experienceData') }}";
                const experienceResponse = await axios.get(experienceURL);
                let eHtml = '';
                experienceResponse.data.forEach(experience => {
                    eHtml += `<div class="card shadow border-0 rounded-4 mb-5">
                                <div class="card-body p-5">
                                    <div class="row align-items-center gx-5">
                                        <div class="col text-center text-lg-start mb-4 mb-lg-0">
                                            <div class="bg-light p-4 rounded-4">
                                                <div class="text-primary fw-bolder mb-2">${experience['duration']}</div>
                                                <div class="small fw-bolder">${experience['title']}</div>
                                                <div class="small text-muted">${experience['designation']}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div>${experience['details']}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
                });
                document.getElementById('experience_data').innerHTML = eHtml;
                document.getElementById('experience_section').classList.remove('d-none');

                //education data loop
                const educationURL = "{{ url('/educationData') }}";
                const educationResponse = await axios.get(educationURL);
                educationResponse.data.forEach(education => {
                    document.getElementById('education_data').innerHTML +=
                        `<div class="card shadow border-0 rounded-4 mb-5">
                            <div class="card-body p-5">
                                <div class="row align-items-center gx-5">
                                    <div class="col text-center text-lg-start mb-4 mb-lg-0">
                                        <div class="bg-light p-4 rounded-4">
                                            <div class="text-secondary fw-bolder mb-2">${education['duration']}</div>
                                            <div class="mb-2">
                                                <div class="small fw-bolder">${education['institute_name']}</div>
                                            </div>
                                            <div class="fst-italic">
                                                <div class="small text-muted">${education['field']}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div>${education['details']}</div>
                                    </div>
                                </div>
                            </div>
                        </div>`;
                });
                document.getElementById('education_section').classList.remove('d-none');

                //skill data loop
                const skillURL = "{{ url('/skillData') }}";
                const skillResponse = await axios.get(skillURL);
                skillResponse.data.forEach(skill => {
                    document.getElementById('skill_data').innerHTML +=
                        `<div class="col mb-4">
                            <div class="d-flex align-items-center bg-light rounded-4 p-3 h-100">${skill['name']}</div>
                        </div>`;
                });
                document.getElementById('skill_section').classList.remove('d-none');

                //language data loop
                const languageURL = "{{ url('/languageData') }}";
                const languageResponse = await axios.get(languageURL);
                languageResponse.data.forEach(language => {
                    document.getElementById('language_data').innerHTML +=
                        `<div class="col mb-4">
                        <div class="d-flex align-items-center bg-light rounded-4 p-3 h-100">${language['name']}</div>
                    </div>`;
                });
                document.getElementById('language_section').classList.remove('d-none');

                //hide loader
                document.getElementById('loader').classList.add('d-none');
            } catch (error) {
                console.log(error);
            }

        })()
    </script>
@endsection
