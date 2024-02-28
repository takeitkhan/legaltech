<template>
  <div class="taxpayer-information">
    <h2
      style="text-align:center;background:#A9D08E;color:black"
      class="py-1 text-uppercase"
    >
      Part-1 : <span>Taxpayer's information</span>
    </h2>
    <div class="taxpayer-information-table">
      <table
        class="table-bordered"
        width="100%"
      >
        <tr>
          <th style="padding:10px;">
            BIN
          </th>
          <th style="text-align:center;padding:10px;">
            :
          </th>
          <th style="padding:10px;">
            {{ currentEntity.bin ? currentEntity.bin:"" }}
          </th>
          <td />
        </tr>
        <tr>
          <th style="padding:10px;">
            Name of Taxpayer
          </th>
          <th style="text-align:center;padding:10px;">
            :
          </th>
          <th style="padding:10px;">
            {{ currentEntity.name ? currentEntity.name:"" }}
          </th>
          <td />
        </tr>
        <tr>
          <th style="padding:10px;">
            Address Of TaxPayer
          </th>
          <th style="text-align:center;padding:10px;">
            :
          </th>
          <th style="padding:10px;">
            {{ currentEntity.name ? currentEntity.address:"" }}
          </th>
          <td />
        </tr>
        <tr>
          <th style="padding:10px;">
            Type Of OwnerShip
          </th>
          <th style="text-align:center;padding:10px;">
            :
          </th>
          <th style="padding:10px;">
            {{ currentEntity.ownership_type ? currentEntity.ownership_type+' Limited':"" }}
          </th>
          <td />
        </tr>
        <tr>
          <th style="padding:10px;">
            Economic Activity
          </th>
          <th style="text-align:center;padding:10px;">
            :
          </th>
          <th style="padding:10px;">
            Service, Retail/Wholesale Trading, Imports
          </th>
          <td />
        </tr>
      </table>
    </div>
  </div>
</template>

<script>
import { mapState } from 'vuex'

export default {
  computed: {
    ...mapState(['currentEntity', 'reportDate', 'reportDateRange']),
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
