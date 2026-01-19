    <div class="lonyo-section-padding4">
        <div class="container">

            @php
                $title = App\Models\Title::find(1);
            @endphp
            <div class="lonyo-section-title center">
                <h2 id="answers-title"
                    contenteditable="{{ auth()->check() && auth()->user()->role === 'admin' ? 'true' : 'false' }}"
                    data-id="{{ $title->id }}">{{ $title->answers }}</h2>
            </div>

            <div class="lonyo-faq-shape"></div>
            <div class="lonyo-faq-wrap1">
                @php
                    $faqs = App\Models\Faq::limit(5)->get();
                @endphp

                @foreach ($faqs as $faq)
                    <div class="lonyo-faq-item item2 open" data-aos="fade-up" data-aos-duration="500">
                        <div class="lonyo-faq-header">
                            <h4>{{ $faq->title }}?</h4>
                            <div class="lonyo-active-icon">
                                <img class="plasicon" src="{{ asset('frontend/assets/images/v1/mynus.svg') }}"
                                    alt="">
                                <img class="mynusicon" src="{{ asset('frontend/assets/images/v1/plas.svg') }}"
                                    alt="">
                            </div>
                        </div>
                        <div class="lonyo-faq-body body2">
                            <p>{{ $faq->description }}.</p>
                        </div>
                    </div>
                @endforeach





            </div>
            <div class="faq-btn" data-aos="fade-up" data-aos-duration="700">
                <a class="lonyo-default-btn faq-btn2" href="faq.html">Can't find your answer</a>
            </div>
        </div>
    </div>


    {{-- csrk token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const titleElement = document.getElementById("answers-title");


            function saveChange(element) {
                let answersId = element.dataset.id;
                let field = element.id === "answers-title" ? "answers" : "";
                let newValue = element.innerText.trim();

                fetch(`/edit-answers/${answersId}`, {
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

            // Auto save on enter key
            function isEditable(el) {
                return el === titleElement;
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
