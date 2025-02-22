<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Template Mo">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Education - List of Meetings</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.7.1/nouislider.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.7.1/nouislider.min.js"></script>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-edu-meeting.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" href="assets/css/lightbox.css">
    <!--

    TemplateMo 569 Edu Meeting

    https://templatemo.com/tm-569-edu-meeting

    -->
</head>

<body>



<!-- Sub Header -->
<div class="sub-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-sm-8">
                <div class="left-content">
                    <p>This is an educational <em>HTML CSS</em> template by TemplateMo website.</p>
                </div>
            </div>
            <div class="col-lg-4 col-sm-4">
                <div class="right-icons">
                    <ul>
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-behance"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ***** Header Area Start ***** -->
<header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <a href="index.html" class="logo">
                        Edu Meeting
                    </a>
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                        <li><a href="index.html">Home</a></li>
                        <li><a href="meetings.html" class="active">Meetings</a></li>
                        <li><a href="index.html">Apply Now</a></li>
                        <li class="has-sub">
                            <a href="javascript:void(0)">Pages</a>
                            <ul class="sub-menu">
                                <li><a href="meetings.html">Upcoming Meetings</a></li>
                                <li><a href="meeting-details.html">Meeting Details</a></li>
                            </ul>
                        </li>
                        <li><a href="index.html">Courses</a></li>
                        <li><a href="index.html">Contact Us</a></li>
                    </ul>
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                    <!-- ***** Menu End ***** -->
                </nav>
            </div>
        </div>
    </div>
</header>
<!-- ***** Header Area End ***** -->

<section class="heading-page header-text" id="top">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h6>Here are our upcoming meetings</h6>
                <h2>Upcoming Meetings</h2>
            </div>
        </div>
    </div>
</section>
<div class="search-container">
    <div class="sidebar">
        <!-- Keyword search -->
        <div class="filter-section">
            <h3>Keyword search</h3>
            <div class="search-wrapper">
                <span class="search-icon">🔍</span>
                <input type="text" class="search-box" placeholder="Enter keywords...">
            </div>
        </div>

        <!-- Course type -->
        <div class="filter-section">
            <h3>Course type</h3>
            <select class="dropdown">
                <option>Please select</option>
                <option>Bachelor's degree</option>
                <option>Master's degree</option>
                <option>PhD</option>
            </select>
        </div>

        <!-- Field of Study -->
        <div class="filter-section">
            <h3>Field of Study</h3>
            <select class="dropdown">
                <option>Please select</option>
                <option>Computer Science</option>
                <option>Engineering</option>
                <option>Business</option>
            </select>
        </div>

        <!-- Course Language -->
        <div class="filter-section">
            <h3>Course Language</h3>
            <select id="language-dropdown"  class="dropdown">
                <option value="">Please select</option>
                @foreach($languages as $language)
                    <option value="{{ $language->id }}">{{ $language->name }}</option>
                @endforeach

            </select>
        </div>

        <!-- Mode of Study -->
        <div class="filter-section">
            <h3>Mode of Study</h3>
            <select class="dropdown">
                <option>Please select</option>
                <option>Full-time</option>
                <option>Part-time</option>
                <option>Distance learning</option>
            </select>
        </div>

        <!-- Department -->
        <div class="filter-section">
            <h3>Department</h3>
            <select class="dropdown">
                <option>Please select</option>
            </select>
        </div>

        <!-- Duration -->
        <!-- <div class="filter-section">
            <h3>Duration</h3>
            <input type="range" class="dropdown" min="1" max="8" value="4">
            <div style="display: flex; justify-content: space-between; font-size: 12px;">
                <span>1 semester</span>
                <span>8 semesters</span>
            </div>
        </div> -->

        <div class="filter-section">
            <h3>Duration</h3>
            <div id="range-slider"></div>
            <div style="display: flex; justify-content: space-between; font-size: 12px;">
                <span id="minLabel">1 semester</span>
                <span id="maxLabel">8 semesters</span>
            </div>
        </div>

        <h4 style="size: 20px; padding-bottom: 10px;">Location</h4>


        <!-- City -->
        <div class="filter-section">
            <h3>City</h3>
            <select class="dropdown">
                <option>Please select</option>
            </select>
        </div>

        <!-- Type of institution -->
        <div class="filter-section">
            <h3>Type of institution</h3>
            <select class="dropdown">
                <option>Please select</option>
                <option>University</option>
                <option>University of Applied Sciences</option>
            </select>
        </div>
        <!-- Institution -->
        <div class="filter-section">
            <h3>Institution</h3>
            <select class="dropdown">
                <option>Please select</option>
                <option>University</option>
                <option>University of Applied Sciences</option>
            </select>
        </div>

        <div style="size: 10px; padding-bottom: 10px;">Course Type Specific</div>

        <!-- Tuition Fee -->
        <div class="filter-section">
            <h3>Tuition Fee</h3>
            <select class="dropdown">
                <option>Please select</option>
                <option>No tuition fee</option>
                <option>Up to 500 EUR per semester</option>
                <option>Up to 1000 EUR per semester</option>
                <option>More than 1000 EUR per semester</option>
            </select>
        </div>

        <!-- Beginning -->
        <div class="filter-section">
            <h3>Beginning</h3>
            <select class="dropdown">
                <option>Please select</option>
                <option>Winter semester</option>
                <option>Summer semester</option>
            </select>
        </div>

        <!-- Date -->
        <div class="filter-section">
            <h3>Date</h3>
            <input type="date" class="dropdown">
        </div>

        <!-- Preparation for subject groups -->
        <div class="filter-section">
            <h3>Preparation for subject groups</h3>
            <select class="dropdown">
                <option>Please select</option>
            </select>
        </div>
        <!-- Preparation for degree programs -->
        <div class="filter-section">
            <h3>Preparation for degree programs</h3>
            <select class="dropdown">
                <option>Please select</option>
            </select>
        </div>

        <!-- Language level -->
        <div class="filter-section">
            <h3>Language level</h3>
            <div class="expand-button">Show options</div>
        </div>

        <!-- GPA -->
        <div class="filter-section">
            <h3>GPA</h3>
            <div class="expand-button">Show options</div>
        </div>

        <!-- Type of appliance -->
        <div class="filter-section">
            <h3>Type of appliance</h3>
            <select class="dropdown">
                <option>Please select</option>
                <option>Direct application</option>
                <option>Through uni-assist</option>
            </select>
        </div>

        <!-- Academic Standardized Tests -->
        <div class="filter-section">
            <h3>Academic Standardized Tests</h3>
            <select class="dropdown">
                <option>Please select</option>
                <option>GRE</option>
                <option>GMAT</option>
            </select>
        </div>

        <!-- deadline -->
        <div class="filter-section">
            <h3>Deadline</h3>
            <input type="date" class="dropdown">
        </div>
        <!-- Combined Degree -->
        <div class="filter-section">
            <h3>Combined Degree</h3>
            <select class="dropdown">
                <option>Please select</option>
                <option>NO</option>
                <option>YES</option>
            </select>
        </div>

        <!-- Joint degree programs -->
        <div class="filter-section">
            <h3>Joint degree programs</h3>
            <select class="dropdown">
                <option>Please select</option>
                <option>NO</option>
                <option>YES</option>
            </select>
        </div>
    </div>

    <div class="main-content">
        <div class="results-header">
            <div>
                <h2>63 results for your criteria</h2>
                <p>Your criteria: artificial intelligence</p>
            </div>
            <div class="view-options">
                <select class="dropdown">
                    <option>Standard sorting</option>
                    <option>sorting by city</option>
                    <option>sorting by name</option>
                </select>
                <button class="view-button">Grid</button>
                <button class="view-button">List</button>
                <button class="view-button">Show map</button>
            </div>
        </div>

        <!-- Result Card 1 -->
        <div class="result-card">
            <div class="action-buttons">
                <button class="action-button">🔖</button>
                <button class="action-button">⚖️</button>
            </div>
            <h3 class="title">
                Master's degree • AI Artificial Intelligence and Data Science for Digital Business Management – Freiburg Campus • Furtwangen University • Freiburg im Breisgau
            </h3>
            <div class="result-content">
                <div class="details-grid">
                    <span class="label">Subject</span>
                    <span>Computer Science</span>

                    <span class="label">Language</span>
                    <span id="language-text">English</span>

                    <span class="label">Beginning</span>
                    <span>Summer semester</span>

                    <span class="label">Duration</span>
                    <span>3 semesters</span>

                    <span class="label">Tuition fees per semester</span>
                    <span>varied</span>
                </div>
                <img src="/api/placeholder/300/200" alt="Students working on computers" class="result-image">
            </div>
            <div class="tag">Hybrid</div>
        </div>



    </div>
</div>
<!-- <section class="meetings-page" id="meetings">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="row">
          <div class="col-lg-12">
            <div class="filters">
              <ul>
                <li data-filter="*"  class="active">All Meetings</li>
                <li data-filter=".soon">Soon</li>
                <li data-filter=".imp">Important</li>
                <li data-filter=".att">Attractive</li>
              </ul>
            </div>
          </div>
          <div class="col-lg-12">
            <div class="row grid">
              <div class="col-lg-4 templatemo-item-col all soon">
                <div class="meeting-item">
                  <div class="thumb">
                    <div class="price">
                      <span>$14.00</span>
                    </div>
                    <a href="meeting-details.html"><img src="assets/images/meeting-01.jpg" alt=""></a>
                  </div>
                  <div class="down-content">
                    <div class="date">
                      <h6>Nov <span>12</span></h6>
                    </div>
                    <a href="meeting-details.html"><h4>New Lecturers Meeting</h4></a>
                    <p>Morbi in libero blandit lectus<br>cursus ullamcorper.</p>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 templatemo-item-col all imp">
                <div class="meeting-item">
                  <div class="thumb">
                    <div class="price">
                      <span>$22.00</span>
                    </div>
                    <a href="meeting-details.html"><img src="assets/images/meeting-02.jpg" alt=""></a>
                  </div>
                  <div class="down-content">
                    <div class="date">
                      <h6>Nov <span>14</span></h6>
                    </div>
                    <a href="meeting-details.html"><h4>Online Teaching Techniques</h4></a>
                    <p>Morbi in libero blandit lectus<br>cursus ullamcorper.</p>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 templatemo-item-col all soon">
                <div class="meeting-item">
                  <div class="thumb">
                    <div class="price">
                      <span>$24.00</span>
                    </div>
                    <a href="meeting-details.html"><img src="assets/images/meeting-03.jpg" alt=""></a>
                  </div>
                  <div class="down-content">
                    <div class="date">
                      <h6>Nov <span>16</span></h6>
                    </div>
                    <a href="meeting-details.html"><h4>Network Teaching Concept</h4></a>
                    <p>Morbi in libero blandit lectus<br>cursus ullamcorper.</p>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 templatemo-item-col all att">
                <div class="meeting-item">
                  <div class="thumb">
                    <div class="price">
                      <span>$32.00</span>
                    </div>
                    <a href="meeting-details.html"><img src="assets/images/meeting-04.jpg" alt=""></a>
                  </div>
                  <div class="down-content">
                    <div class="date">
                      <h6>Nov <span>18</span></h6>
                    </div>
                    <a href="meeting-details.html"><h4>Online Teaching Tools</h4></a>
                    <p>Morbi in libero blandit lectus<br>cursus ullamcorper.</p>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 templatemo-item-col all att">
                <div class="meeting-item">
                  <div class="thumb">
                    <div class="price">
                      <span>$34.00</span>
                    </div>
                    <a href="meeting-details.html"><img src="assets/images/meeting-02.jpg" alt=""></a>
                  </div>
                  <div class="down-content">
                    <div class="date">
                      <h6>Nov <span>22</span></h6>
                    </div>
                    <a href="meeting-details.html"><h4>New Teaching Techniques</h4></a>
                    <p>Morbi in libero blandit lectus<br>cursus ullamcorper.</p>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 templatemo-item-col all imp">
                <div class="meeting-item">
                  <div class="thumb">
                    <div class="price">
                      <span>$45.00</span>
                    </div>
                    <a href="meeting-details.html"><img src="assets/images/meeting-03.jpg" alt=""></a>
                  </div>
                  <div class="down-content">
                    <div class="date">
                      <h6>Nov <span>24</span></h6>
                    </div>
                    <a href="meeting-details.html"><h4>Technology Conference</h4></a>
                    <p>TemplateMo is the best website<br>when it comes to Free CSS.</p>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 templatemo-item-col all imp att">
                <div class="meeting-item">
                  <div class="thumb">
                    <div class="price">
                      <span>$52.00</span>
                    </div>
                    <a href="meeting-details.html"><img src="assets/images/meeting-01.jpg" alt=""></a>
                  </div>
                  <div class="down-content">
                    <div class="date">
                      <h6>Nov <span>27</span></h6>
                    </div>
                    <a href="meeting-details.html"><h4>Online Teaching Techniques</h4></a>
                    <p>Morbi in libero blandit lectus<br>cursus ullamcorper.</p>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 templatemo-item-col all soon imp">
                <div class="meeting-item">
                  <div class="thumb">
                    <div class="price">
                      <span>$64.00</span>
                    </div>
                    <a href="meeting-details.html"><img src="assets/images/meeting-02.jpg" alt=""></a>
                  </div>
                  <div class="down-content">
                    <div class="date">
                      <h6>Nov <span>28</span></h6>
                    </div>
                    <a href="meeting-details.html"><h4>Instant Lecture Design</h4></a>
                    <p>Morbi in libero blandit lectus<br>cursus ullamcorper.</p>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 templatemo-item-col all att soon">
                <div class="meeting-item">
                  <div class="thumb">
                    <div class="price">
                      <span>$74.00</span>
                    </div>
                    <a href="meeting-details.html"><img src="assets/images/meeting-03.jpg" alt=""></a>
                  </div>
                  <div class="down-content">
                    <div class="date">
                      <h6>Nov <span>30</span></h6>
                    </div>
                    <a href="meeting-details.html"><h4>Online Social Networking</h4></a>
                    <p>Morbi in libero blandit lectus<br>cursus ullamcorper.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-12">
            <div class="pagination">
              <ul>
                <li><a href="#">1</a></li>
                <li class="active"><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#"><i class="fa fa-angle-right"></i></a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="footer">
    <p>Copyright © 2022 Edu Meeting Co., Ltd. All Rights Reserved.
        <br>Design: <a href="https://templatemo.com/page/1" target="_parent" title="website templates">TemplateMo</a></p>
  </div>
</section> -->


<!-- Scripts -->
<!-- Bootstrap core JavaScript -->
<script src="index.js"></script>
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="assets/js/isotope.min.js"></script>
<script src="assets/js/owl-carousel.js"></script>
<script src="assets/js/lightbox.js"></script>
<script src="assets/js/tabs.js"></script>
<script src="assets/js/isotope.js"></script>
<script src="assets/js/video.js"></script>
<script src="assets/js/slick-slider.js"></script>
<script src="assets/js/custom.js"></script>
<script>
    //according to loftblog tut
    $('.nav li:first').addClass('active');

    var showSection = function showSection(section, isAnimate) {
        var
            direction = section.replace(/#/, ''),
            reqSection = $('.section').filter('[data-section="' + direction + '"]'),
            reqSectionPos = reqSection.offset().top - 0;

        if (isAnimate) {
            $('body, html').animate({
                    scrollTop: reqSectionPos },
                800);
        } else {
            $('body, html').scrollTop(reqSectionPos);
        }

    };

    var checkSection = function checkSection() {
        $('.section').each(function () {
            var
                $this = $(this),
                topEdge = $this.offset().top - 80,
                bottomEdge = topEdge + $this.height(),
                wScroll = $(window).scrollTop();
            if (topEdge < wScroll && bottomEdge > wScroll) {
                var
                    currentId = $this.data('section'),
                    reqLink = $('a').filter('[href*=\\#' + currentId + ']');
                reqLink.closest('li').addClass('active').
                siblings().removeClass('active');
            }
        });
    };

    $('.main-menu, .responsive-menu, .scroll-to-section').on('click', 'a', function (e) {
        e.preventDefault();
        showSection($(this).attr('href'), true);
    });

    $(window).scroll(function () {
        checkSection();
    });


    var slider = document.getElementById('range-slider');
    var minLabel = document.getElementById("minLabel");
    var maxLabel = document.getElementById("maxLabel");

    noUiSlider.create(slider, {
        start: [2, 6],  // начальные значения
        connect: true,
        range: {
            'min': 1,
            'max': 8
        },
        step: 1,
        tooltips: true,
        format: {
            to: value => Math.round(value),
            from: value => Math.round(value)
        }
    });

    slider.noUiSlider.on('update', function (values) {
        minLabel.textContent = values[0] + " semester" + (values[0] > 1 ? "s" : "");
        maxLabel.textContent = values[1] + " semester" + (values[1] > 1 ? "s" : "");
    });



</script>
<script>{{ asset('js/index.js') }}</script>
<script>
    function getLanguages() {
        let url = "{{ route('languages') }}";

        const dropdown = document.getElementById("language-dropdown");
        const languageText = document.getElementById("language-text");

        dropdown.addEventListener("change", async function () {
            const languageId = dropdown.value;

            if (languageId) {
                languageText.textContent = "Loading..."; // Временный текст

                try {
                    const response = await fetch(url);
                    const data = await response.json();

                    languageText.textContent = data.language || "Not found"; // Обновляем язык
                } catch (error) {
                    console.error("Ошибка загрузки языка:", error);
                    languageText.textContent = "Error"; // Если ошибка, показать "Error"
                }
            } else {
                languageText.textContent = "Please select a language"; // Если язык не выбран
            }
        });
    }
</script>

</body>

</html>
