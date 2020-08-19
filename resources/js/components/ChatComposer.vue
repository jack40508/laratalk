<template>
  <div class="chat-composer">
    <input type="text" placeholder="メッセージを入力してください" v-model="messageText" @keydown.enter="sendMessage">
    <button class="btn btn-primary" @click="sendMessage">送信</button>
  </div>
</template>

<script>
  export default{
    data(){
      return{
        messageText: ''
      }
    },
    methods: {
      sendMessage(){
        this.$emit('messagesent', {
          message: this.messageText
        });
        console.log('send message:' + this.messageText);
        this.messageText = '';
      }
    }
  }
</script>

<style lang="css">
  .chat-composer{
    display: flex;
  }

  .chat-composer input{
    flex:1 auto;
  }

  .chat-composer button{
    border-radius: 0;
  }
</style>
