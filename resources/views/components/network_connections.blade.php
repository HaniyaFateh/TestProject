<div class="row justify-content-center mt-5">
  <div class="col-12">
    <div class="card shadow  text-white bg-dark">
      <div class="card-header">Coding Challenge - Network connections</div>
      <div class="card-body">
        <div class="btn-group w-100 mb-3" role="group" aria-label="Basic radio toggle button group">
          <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked>
          <label class="btn btn-outline-primary tab-switcher" data-tab_index="0" tabindex="0" for="btnradio1" id="get_suggestions_btn">Suggestions(<span id="count_suggestions"></span>)</label>

          <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">
          <label class="btn btn-outline-primary tab-switcher" data-tab_index="1" tabindex="0" for="btnradio2" id="get_sent_requests_btn">Sent Requests(<span id="count_sent"></span>)</label>

          <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off">
          <label class="btn btn-outline-primary tab-switcher" data-tab_index="2" tabindex="0" for="btnradio3" id="get_received_requests_btn">Received Requests(<span id="count_received"></span>)</label>

          <input type="radio" class="btn-check" name="btnradio" id="btnradio4" autocomplete="off">
          <label class="btn btn-outline-primary tab-switcher" data-tab_index="3" tabindex="0" for="btnradio4" id="get_connections_btn">Connections(<span id="count_connections"></span>)</label>
        </div>
        <hr>


        <div id="content" >

        <div class="tab_container" data-tab_index="0" >
          <span class="fw-bold">Suggestion Blade</span>
          <x-suggestion />
          </div>

          <div class="tab_container" data-tab_index="1"  style="display:none;">
          <span class="fw-bold">Sent Request Blade</span>
          <x-request :mode="'sent'" />
          </div>

          <div class="tab_container" data-tab_index="2" style="display:none;">
          <span class="fw-bold">Received Request Blade</span>
          <x-request :mode="'received'" />
          </div>

          <div class="tab_container" data-tab_index="3" style="display:none;">
          <span class="fw-bold">Connection Blade (Click on "Connections in common" to see the connections in common
            component)</span>
          <x-connection />
          </div>
        </div>

    

        <!-- <div id="skeleton" class="d-none">
          @for ($i = 0; $i < 10; $i++)
            <x-skeleton />
          @endfor
        </div>

        <span class="fw-bold">"Load more"-Button</span>
        <div class="d-flex justify-content-center mt-2 py-3 {{-- d-none --}}" id="load_more_btn_parent">
          <button class="btn btn-primary" onclick="" id="load_more_btn">Load more</button>
        </div> -->
      </div>
    </div>
  </div>
</div>

{{-- Remove this when you start working, just to show you the different components --}}

<!-- <div id="connections_in_common_skeleton" class="{{-- d-none --}}">
  <br>
  <span class="fw-bold text-white">Loading Skeletons</span>
  <div class="px-2">
    @for ($i = 0; $i < 10; $i++)
      <x-skeleton />
    @endfor
  </div>
</div> -->
