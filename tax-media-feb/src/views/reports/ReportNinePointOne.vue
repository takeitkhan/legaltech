<template>

  <section
    class=" mt-1"
    style="margin:0 auto;width:80%;"
  >
    <div class="report-nine-point-one bg-white py-2">
      <ReportNinePointOneHeader />
      <NinePointOnePart1 />
      <NinePointOnePart2 />
      <NinePointOnePart3 />
      <NinePointOnePart4 />
      <NinePointOnePart5 />
      <NinePointOnePart6 />
      <NinePointOnePart7 />
      <NinePointOnePart8 />
      <NinePointOnePart9 />
      <NinePointOnePart10 />
      <NinePointOnePart11 />
      <NinePointOnePart12 />
    </div>
    <div class="d-flex mt-2 justify-content-end ">
      <a
        class="btn btn-info mr-2"
        @click.prevent="generatePdf"
      >
        <mdicon
          size="20"
          style="color:#ffff!important"
          name="file-pdf-box"
        />Export PDF</a>
      <a class="btn btn-primary">
        <mdicon
          size="20"
          style="color:#ffff!important"
          name="logout"
        />Export Excel</a>
    </div>
  </section>
</template>

<script>
// import {
//   BDropdown, BDropdownItem,
// } from 'bootstrap-vue

import { mapState } from 'vuex'
import EntityApi from '@/api/entity/EntityApi'
import NinePointOnePart2 from '../../components/reports/NinePointOnePart2.vue'
import NinePointOnePart3 from '../../components/reports/NinePointOnePart3.vue'
import NinePointOnePart4 from '../../components/reports/NinePointOnePart4.vue'
import NinePointOnePart5 from '../../components/reports/NinePointOnePart5.vue'
import NinePointOnePart6 from '../../components/reports/NinePointOnePart6.vue'
import NinePointOnePart7 from '../../components/reports/NinePointOnePart7.vue'
import NinePointOnePart1 from '../../components/reports/NinePointOnePart1.vue'
import NinePointOnePart8 from '../../components/reports/NinePointOnePart8.vue'
import NinePointOnePart9 from '../../components/reports/NinePointOnePart9.vue'
import NinePointOnePart10 from '../../components/reports/NinePointOnePart10.vue'
import NinePointOnePart11 from '../../components/reports/NinePointOnePart11.vue'
import NinePointOnePart12 from '../../components/reports/NinePointOnePart12.vue'
import ReportNinePointOneHeader from '../../components/reports/ReportNinePointOneHeader.vue'

export default {
  components: {
    ReportNinePointOneHeader,
    NinePointOnePart1,
    NinePointOnePart2,
    NinePointOnePart3,
    NinePointOnePart4,
    NinePointOnePart5,
    NinePointOnePart6,
    NinePointOnePart7,
    NinePointOnePart8,
    NinePointOnePart9,
    NinePointOnePart10,
    NinePointOnePart11,
    NinePointOnePart12,
  },
  computed: {
    ...mapState(['currentEntity', 'reportDate', 'reportDateRange']),
  },
  methods: {
    generatePdf() {
      EntityApi.generatePDFUsingDate(this.currentEntity?.id, this.reportDate, this.reportDateRange)
      console.log('this is generated pdf file ')
    },
  },
}
</script>

<style scoped>
*{
  margin:0;
  padding:0;box-sizing:border-box;
}
.user-timeline-list{
    /* border-left:1px solid */
}
.user-timeline-list .single-timeline .badge{
  width:20px;
  height:20px !important;
  border-radius:50% !important;

}
td,tr,th{
  text-align:left;
  padding:1rem !important;
}
.custom-control-primary{
  padding:0.5rem;
}

tfoot tr,tfoot tr td{
  height:20px !important;
   padding:20px 10px !important;
   background:#fff;
}
</style>
