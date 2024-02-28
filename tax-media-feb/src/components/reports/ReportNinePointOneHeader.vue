<template>
  <div class="report-none-poin-one-header row justify-content-between py-2">
    <div class="img-section col-1">
      <img
        :src="govtLogo"
        width="100px"
        height="80px"
      >
    </div>
    <div class="col-11 ">
      <h2 style="text-align:center;text-transform:uppercase;font-weight:bold;">Government Of the people's Republic of bangladesh national Board of Revenue value added tax return form
      </h2>
      <p style="text-align:center;">
        [See rule 47(1)]
      </p>
      <p style="text-align:center;">
        [Please read the instruction before filling up this form]
      </p>
    </div>
  </div>

</template>

<script>
import govtLogo from '@/assets/gonoprojatontri.jpg'

export default {
  data: () => ({
    govtLogo,
  }),
}

</script>
