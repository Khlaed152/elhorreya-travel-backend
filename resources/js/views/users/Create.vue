<style>


</style>

<template>
    <div>
        <!-- Content Header (Page header) -->
        <header-page :title=" $t('global.create') + ' ' + $t('sidebar.new_user') "></header-page>
        <!-- /.content-header -->
        <section class="content">
            <div class="container-fluid">

                <div class="row mt-3">
                    <div class="col-12">
                        <div class="card">
                            <!-- card-header -->
                            <div class="card-header">
                                <router-link class="btn btn-primary btn-sm" :to="{name: 'users'}">{{ $t('global.show') + ' ' + $t('sidebar.all_users') }}</router-link>
                            </div>
                            <!-- ./card-header -->


                            <!-- form -->
                            <form @submit.prevent="createUser()">
                                <!-- card-body -->
                                <div class="card-body">
                                    <form-user typeForm="create" :form="form"></form-user>
                                </div>
                                <!-- ./card-body -->


                                <!-- card-footer -->
                                <div class="card-footer">
                                    <btn-create :form="form"></btn-create>
                                </div> <!-- ./card-footer -->

                            </form><!-- form -->
                        </div>
                    </div><!-- /.col-12 -->

                </div><!-- /.row -->
            </div><!--/. container-fluid -->
        </section>
    </div>
</template>


<script>
import FormUser from './Form'
import BtnCreate from './../../components/form/BtnCreate'
import HeaderPage from './../../components/HeaderPage'

import MixinChangeLocaleMessages from "./../../mixins/MixinChangeLocaleMessages"

export default {
    mixins: [MixinChangeLocaleMessages],
    name: 'create-user',
    components: {
        HeaderPage,
        FormUser,
        BtnCreate
    },
    data() {
      return {
        urlModel: '/users',
        form: new Form({
          name: "",
          email: "",
          password: "",
          password_confirmation: "",
          image: ""
        }),
        idPage: 'users',
        typePage: 'create'
      }
    },
    methods: {
        createUser() {
            loadReq(this.$Progress);
            this.form.post(this.urlModel).then(response => {
                if (response.status === 200) {
                    this.form.reset();
                    ToastReq.fire({
                        text: this.success_msg
                    });
                }
            }).catch(response => {
                ToastFailed.fire({
                    title: this.failed_title + "!",
                    text: this.failed_msg,
                })
                this.$Progress.fail();
            });
        },
    },
    beforeRouteEnter (to, from, next) {
        next(vm => {
            to.meta.title = vm.$t('global.create') + ' ' + vm.$t('sidebar.new_user')
        })
    }
}
</script>
