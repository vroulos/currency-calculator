


new Vue({
    el: '#app-vue',
    data:{
        
        form: {
            value:null,
            from:null,
            to:null
        }
    },

    methods: {
        submit:function()
        {
            if(!this.form.value){
                return false;
                alert('allaal');
            }

            
            axios.post('/computeCurrency', {
              value: this.form.value,
              from: this.form.from,
              to: this.form.to
            })
              .then((response) => {
                const data = response.data;
                // this.users.push(data);
                // this.newUser = '';
                // this.submitting = false;
              });    

        }
    }

 
});
