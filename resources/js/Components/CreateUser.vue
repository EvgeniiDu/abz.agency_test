<script setup>
import axios from "axios";
import  {reactive, computed, ref} from "vue";


const errors = ref();
const preloader = ref(false);
const user = reactive({
        name: '',
        lastname: '',
        phone: '',
        email: '',
        image: null,
    });

const submit = (e) =>{
    e.preventDefault()
    preloader.value = true
    errors.value = ''
    axios.post("http://127.0.0.1:8000/api/users", user, {
        headers:{
            "Content-Type": "multipart/form-data"
        }
    })
        .then(res => {
            if(res.status === 201){
                window.location.href = '/';
            }
        })
        .catch((e) =>{
            if(e.response.status === 422){
                errors.value = e.response.data.errors
            }
        });
};

const previewImagePath = computed(() =>{
    if(user.image){
       return  URL.createObjectURL(user.image)
    }
    return '#'
});
const uploadFile = (e) =>{
    const [file] = e.target.files;
    user.image = file;
}
</script>

<template>
    <div class="container col-4 p-5">
        <form @submit="submit" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" aria-describedby="name" v-model="user.name" >
                <div v-if="errors">
                    <div v-for="(field, k) in errors" :key="k">
                        <div v-if="k === 'name'">
                            <p v-for="error in field" :key="error" class="text-danger">
                                {{ error }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="lastname" class="form-label">Lastname</label>
                <input type="text" class="form-control" id="lastname" aria-describedby="lastname" v-model="user.lastname" >
                <div v-if="errors">
                    <div v-for="(field, k) in errors" :key="k">
                        <div v-if="k === 'lastname'">
                            <p v-for="error in field" :key="error" class="text-danger">
                                {{ error }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="tel" class="form-control" id="phone" aria-describedby="phone" v-model="user.phone" placeholder="+3 (___) ___ __ __">
                <div v-if="errors">
                    <div v-for="(field, k) in errors" :key="k">
                        <div v-if="k === 'lastname'">
                            <p v-for="error in field" :key="error" class="text-danger">
                                {{ error }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" aria-describedby="emailHelp" v-model="user.email">
                <div v-if="errors">
                    <div v-for="(field, k) in errors" :key="k">
                        <div v-if="k === 'email'">
                            <p v-for="error in field" :key="error" class="text-danger">
                                {{ error }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" class="form-control" id="image" name="image" aria-describedby="image" @change="uploadFile">
                <img :src="previewImagePath" class="w-25" alt="" >
                <div v-if="errors">
                    <div v-for="(field, k) in errors" :key="k">
                        <div v-if="k === 'image'">
                            <p v-for="error in field" :key="error" class="text-danger">
                                {{ error }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary focus">Submit</button>
            <div v-show="preloader">
                <img :src="'./storage/preloaders/Spinner-2.gif'" alt="">
            </div>
        </form>
    </div>
</template>

<style scoped>

</style>
