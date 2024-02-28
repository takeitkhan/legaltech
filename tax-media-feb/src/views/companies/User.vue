<template>

  <section id="dashboard-ecommerce">

    <div class="row match-height">
      <!-- Company Table Card -->
      <div class="col-lg-3 col-12 ">
        <div class="card card-company-table ml-2">
          <div class="card-header d-flex flex-column pt-2 align-items-center p-0">
            <img
              class="rounded mb-2"
              width="100"
              height="100"
              src="../../assets/images/avatars/1.png"
            >
            <h2>Noor Alam</h2>
          </div>
          <div class="card-body d-flex flex-column ml-2 ">

            <div class="task d-flex justify-content-around mt-2">
              <div class="single-task d-flex">
                <p
                  class="text-success p-1 mr-1 rounded-sm"
                  style="background:rgba(0,0,0,0.1)"
                >
                  <mdicon
                    size="20"
                    name="check-bold"
                  />
                </p>
                <div>
                  <p
                    class="text-dark"
                    style="font-size:20px;"
                  >
                    1568
                  </p>
                  <p>Task Done</p>
                </div>
              </div>
              <div class="single-task d-flex">
                <p
                  class="text-warning p-1 mr-1 rounded-sm"
                  style="background:rgba(0,0,0,0.1)"
                >
                  <mdicon
                    size="20"
                    name="file-sync"
                  />
                </p>
                <div>
                  <p
                    class="text-dark"
                    style="font-size:20px;"
                  >
                    1568
                  </p>
                  <p>Assign Task</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card ml-2 mt-4">
          <div class="card-header">
            <div class="d-flex align-items-center mt-1">
              <p class="mr-2 ">
                <mdicon
                  size="20"
                  class="font-weight-bold"
                  name="format-list-bulleted"
                /></p>
              <h5 class="font-weight-bold">
                User TimeLine
              </h5>
            </div>
            <div class="user-timeline-list">
              <div class="single-timeline">
                <div class="badge badge-danger" />
              </div>
            </div>
          </div>
          <div class="card-body">
            <ul class="timeline">
              <li class="timeline-item">
                <span class="timeline-point timeline-point-indicator" />
                <div class="timeline-event">
                  <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                    <h6>12 Invoices have been paid</h6>
                    <span class="timeline-event-time">12 min ago</span>
                  </div>
                  <p>Invoices have been paid to the company.</p>
                  <div class="media align-items-center">
                    <img
                      class="mr-1"
                      src="../../assets/images/icons/file-icons/pdf.png"
                      alt="invoice"
                      height="23"
                    >
                    <div class="media-body">
                      invoice.pdf
                    </div>
                  </div>
                </div>
              </li>
              <li class="timeline-item">
                <span class="timeline-point timeline-point-warning timeline-point-indicator" />
                <div class="timeline-event">
                  <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                    <h6>Client Meeting</h6>
                    <span class="timeline-event-time">45 min ago</span>
                  </div>
                  <p>Project meeting with john @10:15am.</p>
                  <div class="media align-items-center">
                    <div class="avatar">
                      <img
                        src="../../assets/images/avatars/12-small.png"
                        alt="avatar"
                        height="38"
                        width="38"
                      >
                    </div>
                    <div class="media-body ml-50">
                      <h6 class="mb-0">
                        John Doe (Client)
                      </h6>
                      <span>CEO of Infibeam</span>
                    </div>
                  </div>
                </div>
              </li>
              <li class="timeline-item">
                <span class="timeline-point timeline-point-info timeline-point-indicator" />
                <div class="timeline-event">
                  <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                    <h6>Create a new project for client</h6>
                    <span class="timeline-event-time">2 days ago</span>
                  </div>
                  <p class="mb-0">
                    Add files to new design folder
                  </p>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <!--/ Company Table Card -->
      <div class="col-lg-8 col-12 mt-2">
        <!-- support tracker card  -->
        <div class="card">
          <div class="row  pb-0 px-4 py-2">
            <h4 class="card-title col-10">
              Support Tracker
            </h4>
            <select
              class="col-2 form-control"
              style="width:50px !important;"
            >
              <option value="#">
                Last 7 days
              </option>
              <option value="#">
                Last 8 days
              </option>
              <option value="#">
                Last 6 days
              </option>
            </select>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-lg-4  col-12 ">
                <!-- single tracker  -->
                <div class="d-flex  flex-column flex-wrap text-center">
                  <h1 class="font-large-3 font-weight-bolder mt-2 mb-0">
                    163
                  </h1>
                  <p class="card-text">
                    Tickets
                  </p>
                </div>
                <!-- end of single tracker  -->
                <!-- single tracker  -->
                <div class="d-flex flex-column flex-wrap text-center">
                  <h5
                    class=" font-weight-bolder mt-2 mb-0"
                    style="font-size:20px;"
                  >
                    New Issue
                  </h5>
                  <p
                    class="card-text text-success mt-1 font-weight-bolder"
                    style="font-size:18px; "
                  >
                    29
                  </p>
                </div>
                <!-- end of single tracker  -->
                <!-- single tracker  -->
                <div class="d-flex flex-column flex-wrap text-center">
                  <h5
                    class=" font-weight-bolder mt-2 mb-0"
                    style="font-size:20px;"
                  >
                    Open Tickets
                  </h5>
                  <p
                    class="card-text text-primary mt-1 font-weight-bolder"
                    style="font-size:18px; "
                  >
                    63
                  </p>
                </div>
                <!-- end of single tracker  -->
                <!-- single tracker  -->
                <div class="d-flex flex-column flex-wrap text-center">
                  <h5
                    class=" font-weight-bolder mt-2 mb-0"
                    style="font-size:20px;"
                  >
                    Response Time
                  </h5>
                  <p
                    class="card-text text-warning mt-1 font-weight-bolder"
                    style="font-size:18px; "
                  >
                    1 day
                  </p>
                </div>
                <!-- end of single tracker  -->

              </div>

              <div class="col-lg-8 col-12 d-flex justify-content-center align-items-center">
                <div
                  id="support-trackers-chart"
                  style="min-height: 253.208px;"
                >
                  <div
                    id="apexchartsun8mx0mo"
                    class="apexcharts-canvas apexchartsun8mx0mo apexcharts-theme-light"
                    style="width: 300px; height: 253.208px;"
                  >
                    <svg
                      id="SvgjsSvg1635"
                      width="300"
                      height="253.20833333333337"
                      xmlns="http://www.w3.org/2000/svg"
                      version="1.1"
                      xmlns:xlink="http://www.w3.org/1999/xlink"
                      xmlns:svgjs="http://svgjs.com/svgjs"
                      class="apexcharts-svg"
                      xmlns:data="ApexChartsNS"
                      transform="translate(0, 0)"
                      style="background: transparent;"
                    ><g
                      id="SvgjsG1637"
                      class="apexcharts-inner apexcharts-graphical"
                      transform="translate(28, 20)"
                    ><defs id="SvgjsDefs1636"><clipPath id="gridRectMaskun8mx0mo"><rect
                      id="SvgjsRect1639"
                      width="252"
                      height="270"
                      x="-3"
                      y="-1"
                      rx="0"
                      ry="0"
                      opacity="1"
                      stroke-width="0"
                      stroke="none"
                      stroke-dasharray="0"
                      fill="#fff"
                    /></clipPath><clipPath id="gridRectMarkerMaskun8mx0mo"><rect
                      id="SvgjsRect1640"
                      width="250"
                      height="272"
                      x="-2"
                      y="-2"
                      rx="0"
                      ry="0"
                      opacity="1"
                      stroke-width="0"
                      stroke="none"
                      stroke-dasharray="0"
                      fill="#fff"
                    /></clipPath><linearGradient
                      id="SvgjsLinearGradient1645"
                      x1="0"
                      y1="1"
                      x2="1"
                      y2="1"
                    ><stop
                      id="SvgjsStop1646"
                      stop-opacity="1"
                      stop-color="rgba(115,103,240,1)"
                      offset="0"
                    /><stop
                      id="SvgjsStop1647"
                      stop-opacity="1"
                      stop-color="rgba(255,255,255,1)"
                      offset="1"
                    /><stop
                      id="SvgjsStop1648"
                      stop-opacity="1"
                      stop-color="rgba(255,255,255,1)"
                      offset="1"
                    /></linearGradient><linearGradient
                      id="SvgjsLinearGradient1656"
                      x1="0"
                      y1="1"
                      x2="1"
                      y2="1"
                    ><stop
                      id="SvgjsStop1657"
                      stop-opacity="1"
                      stop-color="rgba(115,103,240,1)"
                      offset="0"
                    /><stop
                      id="SvgjsStop1658"
                      stop-opacity="1"
                      stop-color="rgba(234,84,85,1)"
                      offset="1"
                    /><stop
                      id="SvgjsStop1659"
                      stop-opacity="1"
                      stop-color="rgba(234,84,85,1)"
                      offset="1"
                    /></linearGradient></defs><g
                      id="SvgjsG1641"
                      class="apexcharts-radialbar"
                    ><g id="SvgjsG1642"><g
                      id="SvgjsG1643"
                      class="apexcharts-tracks"
                    ><g
                      id="SvgjsG1644"
                      class="apexcharts-radialbar-track apexcharts-track"
                      rel="1"
                    ><path
                      id="apexcharts-radialbarTrack-0"
                      d="M 75.7551829268292 215.83042356502926 A 94.48963414634149 94.48963414634149 0 1 1 170.24481707317074 215.83042356502926"
                      fill="none"
                      fill-opacity="1"
                      stroke="rgba(255,255,255,0.85)"
                      stroke-opacity="1"
                      stroke-linecap="butt"
                      stroke-width="16.828048780487805"
                      stroke-dasharray="0"
                      class="apexcharts-radialbar-area"
                      data:pathOrig="M 75.7551829268292 215.83042356502926 A 94.48963414634149 94.48963414634149 0 1 1 170.24481707317074 215.83042356502926"
                    /></g></g><g id="SvgjsG1650"><g
                      id="SvgjsG1655"
                      class="apexcharts-series apexcharts-radial-series"
                      seriesName="CompletedxTickets"
                      rel="1"
                      data:realIndex="0"
                    ><path
                      id="SvgjsPath1660"
                      d="M 75.7551829268292 215.83042356502926 A 94.48963414634149 94.48963414634149 0 1 1 216.3263099534417 148.78143536953007"
                      fill="none"
                      fill-opacity="0.85"
                      stroke="url(#SvgjsLinearGradient1656)"
                      stroke-opacity="1"
                      stroke-linecap="butt"
                      stroke-width="16.828048780487805"
                      stroke-dasharray="8"
                      class="apexcharts-radialbar-area apexcharts-radialbar-slice-0"
                      data:angle="249"
                      data:value="83"
                      index="0"
                      j="0"
                      data:pathOrig="M 75.7551829268292 215.83042356502926 A 94.48963414634149 94.48963414634149 0 1 1 216.3263099534417 148.78143536953007"
                    /></g><circle
                      id="SvgjsCircle1651"
                      r="81.07560975609758"
                      cx="123"
                      cy="134"
                      class="apexcharts-radialbar-hollow"
                      fill="transparent"
                    /><g
                      id="SvgjsG1652"
                      class="apexcharts-datalabels-group"
                      transform="translate(0, 0) scale(1)"
                      style="opacity: 1;"
                    ><text
                      id="SvgjsText1653"
                      font-family="Helvetica, Arial, sans-serif"
                      x="123"
                      y="129"
                      text-anchor="middle"
                      dominant-baseline="auto"
                      font-size="1rem"
                      font-weight="400"
                      fill="#5e5873"
                      class="apexcharts-text apexcharts-datalabel-label"
                      style="font-family: Helvetica, Arial, sans-serif;"
                    >Completed Tickets</text><text
                      id="SvgjsText1654"
                      font-family="Helvetica, Arial, sans-serif"
                      x="123"
                      y="165"
                      text-anchor="middle"
                      dominant-baseline="auto"
                      font-size="1.714rem"
                      font-weight="400"
                      fill="#5e5873"
                      class="apexcharts-text apexcharts-datalabel-value"
                      style="font-family: Helvetica, Arial, sans-serif;"
                    >83%</text></g></g></g></g><line
                      id="SvgjsLine1661"
                      x1="0"
                      y1="0"
                      x2="246"
                      y2="0"
                      stroke="#b6b6b6"
                      stroke-dasharray="0"
                      stroke-width="1"
                      class="apexcharts-ycrosshairs"
                    /><line
                      id="SvgjsLine1662"
                      x1="0"
                      y1="0"
                      x2="246"
                      y2="0"
                      stroke-dasharray="0"
                      stroke-width="0"
                      class="apexcharts-ycrosshairs-hidden"
                    /></g><g
                      id="SvgjsG1638"
                      class="apexcharts-annotations"
                    /></svg><div class="apexcharts-legend" />
                  </div>
                </div>
                <!-- <div class="resize-triggers">
                  <div class="expand-trigger">
                    <div style="width: 578px; height: 254px;" />
                  </div>
                  <div class="contract-trigger" />
                </div> -->
              </div>
            </div>

          </div>
        </div>
        <!-- end of  support tracker card  -->

        <div class="card">
          <div class="row">
            <div class="col-md-6">
              <div class="px-2 py-5">
                <p>
                  <mdicon
                    size="18"
                    class="font-weight-bold text-primary"
                    name="check-bold"
                  />
                  Submitted
                </p>
                <div
                  class="progress progress-bar-primary"
                  style="margin-top:5px;"
                >

                  <div
                    class="progress-bar"
                    role="progressbar"
                    aria-valuenow="50"
                    aria-valuemin="50"
                    aria-valuemax="100"
                    style="width: 100%"
                    aria-describedby="example-caption-3"
                  />
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="px-2 py-5">
                <p>
                  <mdicon
                    size="18"
                    class="font-weight-bold text-warning"
                    name="account-edit"
                  />
                  Drafted
                </p>
                <div
                  class="progress progress-bar-warning"
                  style=";margin-top:5px;"
                >

                  <div
                    class="progress-bar"
                    role="progressbar"
                    aria-valuenow="50"
                    aria-valuemin="50"
                    aria-valuemax="100"
                    style="width: 100%"
                    aria-describedby="example-caption-3"
                  />
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="px-2 py-5">
                <p class="text-danger">
                  <mdicon
                    size="18"
                    class="font-weight-bold text-danger"
                    name="hexagram-outline"
                  />
                  Review
                </p>
                <div
                  class="progress progress-bar-danger"
                  style=";margin-top:5px;"
                >

                  <div
                    class="progress-bar"
                    role="progressbar"
                    aria-valuenow="50"
                    aria-valuemin="50"
                    aria-valuemax="100"
                    style="width: 100%"
                    aria-describedby="example-caption-3"
                  />
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="px-2 py-5">
                <p class="text-success">
                  <mdicon
                    size="18"
                    class="font-weight-bold text-success"
                    name="text-box-check"
                  />
                  Filed
                </p>
                <div
                  class="progress progress-bar-success"
                  style="margin-top:5px;"
                >

                  <div
                    class="progress-bar"
                    role="progressbar"
                    aria-valuenow="50"
                    aria-valuemin="50"
                    aria-valuemax="100"
                    style="width: 50%"
                    aria-describedby="example-caption-3"
                  />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>

</template>

<script>
import {
  BDropdown, BDropdownItem,
} from 'bootstrap-vue'

export default {
  components: {
    // BCard,
    // BCardText,
    // BLink,
    // BProgress,
    BDropdownItem, BDropdown,
  },
}
</script>

<style>
.user-timeline-list{
    border-left:1px solid
}
.user-timeline-list .single-timeline .badge{
  width:20px;
  height:20px !important;
  border-radius:50% !important;

}
</style>
