<template>
  <div>
    <p>{{ message }}</p>
    <!--<small>{{ message.user.id }}</small>-->
  </div>
</template>

<script>
    export default {
        props: ['message']
    }
</script>
