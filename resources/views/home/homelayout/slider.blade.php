<div class="lonyo-hero-section light-bg">
    @php
        $slider = App\Models\Slider::latest()->first();
    @endphp
    <div class="container">
        <div class="row">
            <div class="col-lg-7 d-flex align-items-center">
                <div class="lonyo-hero-content" data-aos="fade-up" data-aos-duration="700">

                    <h1 id="slider-title"
                        contenteditable="{{ auth()->check() && auth()->user()->role === 'admin' ? 'true' : 'false' }}"
                        data-id="{{ $slider->id }}" class="hero-title">{{ $slider->title }}</h1>
                    <p id="slider-description"
                        contenteditable="{{ auth()->check() && auth()->user()->role === 'admin' ? 'true' : 'false' }}"
                        data-id="{{ $slider->id }}" class="text">{{ $slider->description }}.</p>

                    <div class="mt-50" " data-aos="fade-up" data-aos-duration="900">
                        <a href="{{ $slider->link }}" target="_blank" class="lonyo-default-btn hero-btn">Create a free
                            account</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="lonyo-hero-thumb" data-aos="fade-left" data-aos-duration="700">
                    <img src="{{ !empty($slider->image) ? asset('uploads/sliders/' . $slider->image) : asset('frontend/assets/images/v1/hero-thumb.png') }}"
                        alt="">
                    <div class="lonyo-hero-shape">
                        <img src="{{ asset('frontend/assets/images/shape/hero-shape1.svg') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- csrk token --}}
<meta name="csrf-token" content="{{ csrf_token() }}">

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const titleElement = document.getElementById("slider-title");

        const descriptionElement = document.getElementById("slider-description");

        function saveChange(element) {
            let sliderId = element.dataset.id;
            let field = element.id === "slider-title" ? "title" : "description";
            let newValue = element.innerText.trim();

            fetch(`/edit-slider/${sliderId}`, {
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

        titleElement.addEventListener("blur", () => saveChange(titleElement));
        descriptionElement.addEventListener("blur", () => saveChange(descriptionElement));

        // Auto save on enter key
        function isEditable(el) {
            return el === titleElement || el === descriptionElement;
        }

        document.addEventListener("keydown", function(e) {
            if (e.key === "Enter" && isEditable(e.target)) {
                e.preventDefault();
                saveChange(e.target);
                e.target.blur();
            }
        });




    });
</script>
