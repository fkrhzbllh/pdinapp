<div class="bg-pdin-abu-terang">
	<div class="container padding-tambahan bg-pdin-abu-terang"></div>
	<div class="container">
		<div class="mt-5 row p-5 g-3 bg-white shadow-sm rounded-5">
			<div class="col-lg-8 mb-4 pe-5">
				<h3 class="mb-2">
					<?php echo $artikel['judul'] ?>
				</h3>
				<p class="mt-3 mb-2">
					Rilis Media -
					<?php echo $artikel['tgl_terbit'] ?>
					- Pusat Desain Industri Nasional
				</p>
				<img src="<?php echo base_url() . 'uploads/' . $artikel['featured_image'] ?>"
					alt="" class="img-fluid object-fit-cover rounded-2 my-3" style="width: 100%; max-height: 450px" />
				<?php echo $artikel['konten'] ?>
				<!-- <p>
              This is some additional paragraph placeholder content. It has been
              written to fill the available space and show how a longer snippet
              of text affects the surrounding content. We'll repeat it often to
              keep the demonstration flowing, so be on the lookout for this
              exact same string of text.
            </p>
            <h4>Sub-heading</h4>
            <p>
              This is some additional paragraph placeholder content. It has been
              written to fill the available space and show how a longer snippet
              of text affects the surrounding content. We'll repeat it often to
              keep the demonstration flowing, so be on the lookout for this
              exact same string of text.
            </p>
            <pre><code>Example code block</code></pre>
            <p>
              This is some additional paragraph placeholder content. It's a
              slightly shorter version of the other highly repetitive body text
              used throughout.
            </p>
            <h5>Example lists</h5>
            <p>
              This is some additional paragraph placeholder content. It's a
              slightly shorter version of the other highly repetitive body text
              used throughout. This is an example unordered list:
            </p>
            <ul>
              <li>First list item</li>
              <li>Second list item with a longer description</li>
              <li>Third list item to close it out</li>
            </ul>
            <p>And this is an ordered list:</p>
            <ol>
              <li>First list item</li>
              <li>Second list item with a longer description</li>
              <li>Third list item to close it out</li>
            </ol>

            <p>
              HTML defines a long list of available inline tags, a complete list
              of which can be found on the
              <a
                href="https://developer.mozilla.org/en-US/docs/Web/HTML/Element"
                >Mozilla Developer Network</a
              >.
            </p> -->
			</div>
			<!-- samping sticky -->
			<div class="col-lg-4 mb-4">
				<div class="position-sticky" style="top: 8rem">
					<!-- deskripsi pdin -->
					<!-- <div class="ps-2">
                <div class="p-4 mb-3 bg-body-tertiary rounded">
                  <h5 class="">PDIN</h5>
                  <p class="mb-0">
                    this section to tell your visitors a little bit about your
                    publication, writers, content, or something else entirely.
                    Totally up to you.
                  </p>
                </div>
              </div> -->
					<!-- share -->
					<div class="pt-1 ps-2">
						<h5 class="">Share</h5>
						<!-- input pencarian -->
						<div class="input-group mb-3">
							<input type="text" class="form-control bg-light text-secondary" placeholder="" aria-label=""
								aria-describedby="copy-link"
								value="https://www.pdin.id/rilismedia/grand+launching+pusat+design+industri+nasional"
								id="myInput" />
							<div class="input-group-append">
								<div class="tooltip"></div>
								<button class="btn btn-danger btn-lg rounded-start-0" type="button"
									onclick="myFunction()" onmouseout="outFunc()">
									<span class="bi-link"></span>
								</button>
							</div>
						</div>
						<div class="col-md-12">
							<div class="d-flex flex-grow-1 justify-content-center justify-content-xl-between flex-wrap">
								<a class="btn btn-facebook-1 m-2 m-xl-0 mb-lg-2"
									href="https://www.facebook.com/sharer.php?u=http%3A%2F%2Fcss-tricks.com%2F"
									target="_blank"><span class="bi bi-facebook me-2"></span>Facebook</a>
								<a class="btn btn-twitter-1 m-2 m-xl-0 mb-lg-2" href="https://twitter.com/intent/tweet
                    ?url=http%3A%2F%2Fcss-tricks.com%2F
                    &text=Tips%2C+Tricks%2C+and+Techniques+on+using+Cascading+Style+Sheets.
                    &hashtags=css,html" target="_blank"><span class="bi bi-twitter me-2"></span>Twitter</a>

								<a class="btn btn-linkedin-1 m-2 m-xl-0 mb-lg-2"
									href="https://www.linkedin.com/sharing/share-offsite/?url=https://css-tricks.com"
									target="_blank"><span class="bi bi-linkedin me-2"></span>LinkedIn</a>
							</div>
						</div>
					</div>
					<!-- recent -->
					<div class="pt-4 ps-2">
						<h5 class="">Recent Post</h5>
						<!-- berita -->
						<div class="row mb-3 mx-0">
							<div class="col-12 col-md-6 col-lg-3 p-0">
								<img src="./assets/galeri-1.jpg" class="background-rilismedia-launching rounded-start-2"
									style="max-height: 237px; min-height: 94px" alt="" />
							</div>
							<div class="col-12 col-md-6 col-lg-9 bg-light rounded-end-2" style="max-height: 237px">
								<div class="flex-column m-0 pt-2 pb-1 px-1">
									<p class="">
										<a href="" class="crop-text-2 lh-base fw-bold">Grand Launching Pusat Desain
											Industri Nasional di
											Yogyakarta
										</a>
									</p>
									<small>Pameran | 23 Juni 2023</small>
								</div>
							</div>
						</div>
						<!-- berita -->
						<div class="row mb-3 mx-0">
							<div class="col-12 col-md-6 col-lg-3 p-0">
								<img src="./assets/galeri-1.jpg" class="background-rilismedia-launching rounded-start-2"
									style="max-height: 237px; min-height: 94px" alt="" />
							</div>
							<div class="col-12 col-md-6 col-lg-9 bg-light rounded-end-2" style="max-height: 237px">
								<div class="flex-column m-0 pt-2 pb-1 px-1">
									<p class="">
										<a href="" class="crop-text-2 lh-base fw-bold">Grand Launching Pusat Desain
											Industri Nasional di
											Yogyakarta
										</a>
									</p>
									<small>Pameran | 23 Juni 2023</small>
								</div>
							</div>
						</div>
						<!-- berita -->
						<div class="row mb-3 mx-0">
							<div class="col-12 col-md-6 col-lg-3 p-0">
								<img src="./assets/galeri-1.jpg" class="background-rilismedia-launching rounded-start-2"
									style="max-height: 237px; min-height: 94px" alt="" />
							</div>
							<div class="col-12 col-md-6 col-lg-9 bg-light rounded-end-2" style="max-height: 237px">
								<div class="flex-column m-0 pt-2 pb-1 px-1">
									<p class="">
										<a href="" class="crop-text-2 lh-base fw-bold">Grand Launching Pusat Desain
											Industri Nasional di
											Yogyakarta
										</a>
									</p>
									<small>Pameran | 23 Juni 2023</small>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container padding-tambahan bg-pdin-abu-terang"></div>
</div>