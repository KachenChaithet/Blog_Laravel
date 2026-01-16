  <div class="lonyo-content-shape1">
      <img src="{{ asset('frontend/assets/images/shape/shape1.svg') }}" alt="">
  </div>
  <div class="lonyo-section-padding2 position-relative">
      <div class="container">
          @php
              $title = App\Models\Title::find(1);
          @endphp
          <div class="lonyo-section-title center">
              <h2 id="features-title"
                  contenteditable="{{ auth()->check() && auth()->user()->role === 'admin' ? 'true' : 'false' }}"
                  data-id="{{ $title->id }}">{{ $title->features }}</h2>
          </div>

          <div class="row">
              <div class="col-xl-4 col-lg-6 col-md-6">
                  <div class="lonyo-service-wrap light-bg" data-aos="fade-up" data-aos-duration="500">
                      <div class="lonyo-service-title">
                          <h4>Expense Tracking</h4>
                          <img src="{{ asset('frontend/assets/images/v1/feature1.svg') }}" alt="">
                      </div>
                      <div class="lonyo-service-data">
                          <p>Allows users to record and categorize daily transactions such as income, expenses, bills,
                              and savings.</p>
                      </div>
                  </div>
              </div>
              <div class="col-xl-4 col-lg-6 col-md-6">
                  <div class="lonyo-service-wrap light-bg" data-aos="fade-up" data-aos-duration="700">
                      <div class="lonyo-service-title">
                          <h4>Budgeting Tools</h4>
                          <img src="{{ asset('frontend/assets/images/v1/feature2.svg') }}" alt="">
                      </div>
                      <div class="lonyo-service-data">
                          <p>Provides visual insights like graphs or pie charts to show how much is spent versus the
                              budgeted amount.</p>
                      </div>
                  </div>
              </div>
              <div class="col-xl-4 col-lg-6 col-md-6">
                  <div class="lonyo-service-wrap light-bg" data-aos="fade-up" data-aos-duration="900">
                      <div class="lonyo-service-title">
                          <h4>Investment Tracking</h4>
                          <img src="{{ asset('frontend/assets/images/v1/feature3.svg') }}" alt="">
                      </div>
                      <div class="lonyo-service-data">
                          <p>For users interested in investing, finance apps often provide tools to track stocks,
                              bonds or mutual funds.</p>
                      </div>
                  </div>
              </div>
              <div class="col-xl-4 col-lg-6 col-md-6">
                  <div class="lonyo-service-wrap light-bg" data-aos="fade-up" data-aos-duration="500">
                      <div class="lonyo-service-title">
                          <h4>Tax Management</h4>
                          <img src="{{ asset('frontend/assets/images/v1/feature4.svg') }}" alt="">
                      </div>
                      <div class="lonyo-service-data">
                          <p>This tool integrate with tax software to help users prepare for tax season, deduct
                              expenses, and file returns.</p>
                      </div>
                  </div>
              </div>
              <div class="col-xl-4 col-lg-6 col-md-6">
                  <div class="lonyo-service-wrap light-bg" data-aos="fade-up" data-aos-duration="700">
                      <div class="lonyo-service-title">
                          <h4>Bill Management</h4>
                          <img src="{{ asset('frontend/assets/images/v1/feature5.svg') }}" alt="">
                      </div>
                      <div class="lonyo-service-data">
                          <p>Tracks upcoming bills, sets reminders for due dates, and enables easy payments via
                              integration with online banking</p>
                      </div>
                  </div>
              </div>
              <div class="col-xl-4 col-lg-6 col-md-6">
                  <div class="lonyo-service-wrap light-bg" data-aos="fade-up" data-aos-duration="900">
                      <div class="lonyo-service-title">
                          <h4>Security Features</h4>
                          <img src="{{ asset('frontend/assets/images/v1/feature6.svg') }}" alt="">
                      </div>
                      <div class="lonyo-service-data">
                          <p>Provides bank-level encryption to ensure user data and financial information remain safe,
                              MFA and biometric logins.</p>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="lonyo-feature-shape"></div>
  </div>

  {{-- csrk token --}}
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <script>
      document.addEventListener("DOMContentLoaded", function() {
          const titleElement = document.getElementById("features-title");


          function saveChange(element) {
              let featuresId = element.dataset.id;
              let field = element.id === "features-title" ? "features" : "";
              let newValue = element.innerText.trim();

              fetch(`/edit-features/${featuresId}`, {
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
