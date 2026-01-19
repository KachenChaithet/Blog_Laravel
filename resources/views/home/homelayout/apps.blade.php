<div class="lonyo-content-shape3">
    <img src="{{ asset('frontend/assets/images/shape/shape2.svg') }}" alt="">
</div>
<!-- end faq -->

<section class="lonyo-cta-section bg-heading">
    <div class="container">
        <div class="row">
            @php
                $apps = App\Models\App::findOrFail(1);
            @endphp
            <div class="col-lg-6">
                <div class="lonyo-cta-thumb" data-aos="fade-up" data-aos-duration="500">
                    <img id="app-image" src="{{ asset(path: $apps->image) }}" alt="">
                    @if (auth()->check() && auth()->user()->role === 'admin')
                        <input type="file" id="uploadImage"
                            @if ($apps->image) style="display: none" @endif>
                    @endif
                </div>
            </div>
            <div class="col-lg-6">
                <div class="lonyo-default-content lonyo-cta-wrap" data-aos="fade-up" data-aos-duration="700">
                    <h2 id="app-title"
                        contenteditable="{{ auth()->check() && auth()->user()->role === 'admin' ? 'true' : 'false' }}"
                        data-id="{{ $apps->id }}">{{ $apps->title }}</h2>
                    <p id="app-description"
                        contenteditable="{{ auth()->check() && auth()->user()->role === 'admin' ? 'true' : 'false' }}"
                        data-id="{{ $apps->id }}">{{ $apps->description }}.</p>
                    <div class="lonyo-cta-info mt-50" data-aos="fade-up" data-aos-duration="900">
                        <ul>
                            <li>
                                <a href="https://www.apple.com/app-store/"><img
                                        src="{{ asset('frontend/assets/images/v1/app-store.svg') }}" alt=""></a>
                            </li>
                            <li>
                                <a href="https://playstore.com/"><img
                                        src="{{ asset('frontend/assets/images/v1/play-store.svg') }}"
                                        alt=""></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- csrk token --}}
<meta name="csrf-token" content="{{ csrf_token() }}">

<script>
    document.addEventListener("DOMContentLoaded", function() {


        function saveChange(element) {
            let appsId = element.dataset.id;
            let field = element.id.startsWith("app-title") ? "title" : "description";
            let newValue = element.innerText.trim();

            fetch(`/update-apps/${appsId}`, {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": document
                            .querySelector('meta[name="csrf-token"]')
                            .getAttribute("content"),
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        [field]: newValue
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log(field + " updated successfully");
                    }
                })
                .catch(error => console.error("Error:", error));
        }


        document.querySelectorAll('[id^="app-title"], [id^="app-description"]').forEach(el => {
            el.addEventListener("blur", () => {
                saveChange(el)
            })
        })

        document.addEventListener("keydown", function(e) {
            if (e.key === "Enter") {
                e.preventDefault();
                saveChange(e.target);
                e.target.blur();
            }
        });


        let imageElement = document.getElementById('app-image')
        let uploadInput = document.getElementById('uploadImage')

        imageElement.addEventListener("click", () => {
            uploadInput.click()
        })
        uploadInput.addEventListener("change", (e) => {
            const file = e.target.files[0];
            if (!file) return;

            const formData = new FormData();
            formData.append('image', file);

            fetch('/update-app-image/1', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document
                            .querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        imageElement.src = data.image_url
                        console.log("Image updated successfully");
                    }
                })
                .catch(error => console.error("Error:", error));
        });

    });
</script>
