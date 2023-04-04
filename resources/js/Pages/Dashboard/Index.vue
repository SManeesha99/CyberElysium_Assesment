<template>

      <AppLayout>
            <template #content>


                              <!-- {{-- ==================================student List========================= --}} -->

            <div class="container-fluid">
                <h1>Dashboard</h1>
                  <h1 class="ol-lg-10 text-center">Student List</h1>
                  <table class="table table-responsive-sm table-striped table-hover mt-4 table-center table-bordered" style="width: 70%; margin: 0 auto;">
                        <thead>
                              <tr>
                                <th scope="col" style="width: 5%">id</th>
                                <th scope="col" style="width: 15%">Name</th>
                                <th scope="col" style="width: 3%">Age</th>
                                <th scope="col" style="width: 5%">Image</th>
                                <th scope="col" style="width: 5%">Status</th>
                                <!-- <th scope="col">Action</th> -->
                              </tr>
                            </thead>

                            <tbody>


                              <tr v-for="student in students">
                                    <th scope="row">{{student.id}}</th>
                                    <td>{{ student.name }}</td>
                                    <td>{{ student.age }}</td>
                                    <td><img class="stImg" :src="student.image" style="width: 30%;" /></td>
                                    <td>
                                          <span v-if="student.status == 'active' "><div class="activestatus"></div></span>
                                          <span v-else><div class="deactivestatus"></div></span>
                                    </td>
                                    <!-- <td>
                                          <Link @click.prevent="deleteStudent(student.id)" ><i class="fas fa-trash-alt ms-3 icon" style="color: #db0000;"></i></Link>

                                          <Link v-if="student.status == 'active'" @click.prevent="updateStatus(student.id)" type="button"><i class="fas fa-user-slash ms-3 icon" style="color: #d60000;"></i></Link>
                                          <Link v-else @click.prevent="updateStatus(student.id)" type="button"><i class="fas fa-user-alt ms-3 icon" style="color: #03b300;"></i></Link>
                                          <Link @click.prevent="editStudent(student.id)" type="button" data-bs-toggle="modal" data-bs-target="#updatemodal"><i class="fas fa-user-edit ms-3 icon" style="color: #0844aa;"></i></Link>
                                    </td> -->
                              </tr>




                            </tbody>
                  </table>
            </div>




                  <!-- {{-- ===============================edit model============================          --}} -->


                  <div class="modal fade" id="updatemodal" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                          <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Studnt Details</h1>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body" >

                                          <form @submit.prevent="studentUpdate" >

                                                <div class="row d-grid gap-3">
                                                      <div class="form-floating">
                                                            <input name="name" type="text"  v-model="editStDetails.name" class="form-control" id="floatingPassword" placeholder="Student Name">
                                                            <label class="label" for="floatingPassword">Name</label>
                                                      </div>
                                                      <div class="form-floating">
                                                            <input name="age" type="text"  v-model="editStDetails.age" class="form-control" id="floatingPassword" placeholder="Age">
                                                            <label class="label" for="floatingPassword">Age</label>
                                                      </div>

                                                      <div class="col-lg-4">
                                                            <button type="submit" class="btn btn-primary">Update</button>
                                                      </div>
                                                </div>

                                          </form>

                                    </div>


                                    </div>
                                    </div>
                              </div>

                   <!-- {{-- ===============================edit model============================ --}} -->


            <!-- {{-- ==================================student List========================= --}} -->


            </template>
      </AppLayout>


</template>

<script>

import AppLayout from '@/Layouts/App.vue'
import { router } from '@inertiajs/vue3'
import { Link } from '@inertiajs/vue3';

export default {

components: {
    AppLayout,
    Link

},

  props: {

        students: Array,

  },

  data(){
        return{
              student:{
                    name:'',
                    age:'',
                    image:'',
              },

              editStDetails:{
                    name:'',
                    age:'',
              }
        }
  },

  methods:
  {
        addStudent()
        {
              router.post(route('studentList.add'), this.student);
        },

        async deleteStudent(id)
        {
              await axios.delete(route('student.delete',id))
        },
        async updateStatus(id)
        {
              await axios.get(route('student.statusUpdate',id))
        },
        async editStudent(id)
        {
              const student = (await axios.get(route('student.get',id))).data
              this.editStDetails= student
              $('#updatemodal').modal('show')
        },
        async studentUpdate()
        {
              await axios.post(route('student.update',this.editStDetails.id),this.editStDetails)
              $('#updatemodal').modal('hide');
        }


  }


}


</script>

<style lang="css" scoped>

.page-title{
            padding-top: 10vh;
      }

      .icon{
            font-size: 25px;
      }

      .stImg{
            width: 100px;
      }

      .label{
            padding-left: 20px !important;
      }
      .activestatus{
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: rgb(0, 174, 0);
      }
      .deactivestatus{
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: rgb(216, 2, 2);
      }

</style>
