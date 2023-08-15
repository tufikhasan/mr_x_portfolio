@extends('frontend.master')
@section('content')
    @include('frontend.components.project_section')
    @include('frontend.components.call_to_action')
@endsection
@section('script')
    <script>
        (async () => {
            try {
                document.getElementById("loader").classList.remove("d-none");
                const URL = "{{ url('/projectData') }}";
                const response = await axios.get(URL);
                let html = "";
                response.data.forEach((project) => {
                    html += `
              <div class="card overflow-hidden shadow rounded-4 border-0 mb-5">
                    <div class="card-body p-0">
                        <div class="d-flex align-items-center">
                            <div class="p-5">
                                <a href="${
                                    project['preview_link']
                                }"><h2 class="fw-bolder">${
                    project['title']
                }</h2></a>
                                <p>${project['details']}</p>
                            </div>
                            <img class="img-fluid" src="${
                                project['thumbnail_link']
                                    ? project['thumbnail_link']
                                    : "https://dummyimage.com/300x400/343a40/6c757d"
                            }" alt="${project['title']}" />
                        </div>
                    </div>
                </div>
              `;
                });
                document.getElementById("project_content").innerHTML = html;
                document.getElementById("loader").classList.add("d-none");
                document.getElementById("project_content").classList.remove("d-none");
            } catch (error) {
                console.log(error);
            }
        })();
    </script>
@endsection
