<template>
  <div class="taxpayer-information">
    <h2 style="text-align: center; background: #a9d08e; color: black" class="py-1 text-uppercase">
      Part-2 : <span>RETURN SUBMISSION DATA</span>
    </h2>
    <div class="taxpayer-information-table">
      <table class="table-bordered" width="100%">
        <tr>
          <th style="padding: 10px">Tax Period</th>
          <th style="text-align: center; padding: 10px">:</th>
          <th style="padding: 10px">
            <date-picker v-model="dateRange" type="date" format="YYYY-MM-DD" value-type="format"
              style="margin-right: 2rem" range placeholder="YYYY-MM-DD to YYYY-MM-DD" />
            <strong class="mr-2">OR</strong>

            <date-picker v-model="month" type="month" value-type="format" format="MMMM" style="margin-right: 2rem"
              placeholder="MMMM" />
            <date-picker v-model="year" type="year" format="YYYY" value-type="format" placeholder="Year" />
          </th>
        </tr>
        <tr>
          <th rowspan="4" style="padding-left: 1rem">
            <p style="margin-top: -8rem !important">
              Type Of Return <br />
              [Please select your desired option]
            </p>
          </th>
          <th style="text-align: center; padding: 10px">:</th>
          <td style="padding: 10px; text-transform: capitalize">
            <strong>A)</strong> main/original return (section 64)
          </td>
          <td>
            <b-form-checkbox class="custom-control-primary" />
          </td>
        </tr>
        <tr>
          <td />
          <td><strong>B)</strong> Late Return (section 65)</td>
          <td>
            <b-form-checkbox class="custom-control-primary" />
          </td>
        </tr>
        <tr>
          <td />
          <td><strong>C)</strong>Amended Return (section 65)</td>
          <td>
            <b-form-checkbox class="custom-control-primary" />
          </td>
        </tr>
        <tr>
          <td />
          <td>
            <strong><strong>D)</strong> Full or Additional or Alternative Return (section
              67)</strong>
          </td>
          <td>
            <b-form-checkbox class="custom-control-primary" />
          </td>
        </tr>
        <tr>
          <th style="padding-left: 10px">Any Activities in this Tax Period?</th>
          <th style="text-align: center; padding: 10px">:</th>
          <td>
            <div class="d-flex">
              <label class="d-flex justify-content-start ml-3">
                <span>Yes</span>
                <b-form-checkbox class="custom-control-primary ml-2" />
              </label>
              <label class="d-flex justify-content-start ml-3">
                NO
                <b-form-checkbox class="custom-control-primary ml-2" />
              </label>
            </div>
          </td>
          <td />
        </tr>
        <tr style="padding: 10px">
          <th style="padding: 10px">
            [if Selected "No" please Fill only the relevant Part]
          </th>
          <th />
          <th />
        </tr>
        <tr>
          <th style="padding: 10px">Date of Submission</th>
          <th style="text-align: center; padding: 10px">:</th>
          <th style="padding: 10px">13/03/2022</th>
        </tr>
      </table>
    </div>
  </div>
</template>

<script>
import { mapState } from "vuex";
import { BFormCheckbox } from "bootstrap-vue";
import { format } from "date-fns";

export default {
  components: {
    BFormCheckbox,
  },

  data: () => ({
    month: format(new Date(), 'MMM'),
    year: format(new Date(), 'yyyy'),
    dateRange: [],
  }),
  computed: {
    ...mapState(['currentEntity', 'reportDate', 'reportDateRange']),
    date() {
      return `${this.year}-${this.month}`;
    },
  },
  watch: {
    date(newVal) {
      if (
        newVal !== null &&
        Array.isArray(newVal.split('-')) &&
        newVal.split("-")[1] !== "" &&
        newVal.split("-")[0] !== ""
      ) {
        this.dateRange = []
        this.$store.commit('UPDATE_REPORT_DATE', this.date)
        this.$store.commit('UPDATE_REPORT_DATE_RANGE', [])
      }
    },
    dateRange(newVal) {
      // if date range is array then set month and year null and call getSellsTransactions Function
      if (Array.isArray(newVal) && newVal.length > 0) {
        this.month = null
        this.year = null
        this.$store.commit('UPDATE_REPORT_DATE', null)
        this.$store.commit('UPDATE_REPORT_DATE_RANGE', this.dateRange)
      }
    },
  },
  mounted() {
    const date = this.reportDate;
    if (
      Array.isArray(date?.split("-")) &&
      date.split("-")[1] !== "" &&
      date.split("-")[0] !== ""
    ) {
      const [year, month] = date.split("-");
      this.month = month;
      this.year = format(new Date(year), "yyyy");
    } else if (this.month && this.year) {
      const dateRange = `${this.year}-${this.month}`;
      this.$store.commit("UPDATE_REPORT_DATE", dateRange);
    }
  },
};
</script>

<style scoped>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

.user-timeline-list {
  /* border-left:1px solid */
}

.user-timeline-list .single-timeline .badge {
  width: 20px;
  height: 20px !important;
  border-radius: 50% !important;
}

td,
tr,
th {
  text-align: left;
  padding: 1rem !important;
}

.custom-control-primary {
  padding: 0.5rem;
}

tfoot tr,
tfoot tr td {
  height: 20px !important;
  padding: 20px 10px !important;
  background: #fff;
}
</style>
