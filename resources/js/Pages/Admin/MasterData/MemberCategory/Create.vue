<template>

    <Head>
        <title>{{ $page.props.setting.app_name ?? 'Atur Setting Terlebih Dahulu' }} - Tambah Kategori Member</title>
    </Head>
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Kategori Member</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Tambah Kategori Member</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->

            <div class="card border-top border-0 border-3 border-primary">
                <div class="card-body">
                    <div class="d-lg-flex align-items-center">
                        <div class="ms-auto">
                            <Link href="/admin/member-categories" class="btn btn-primary btn-sm mt-2 mt-lg-0">Kembali
                            </Link>
                        </div>
                    </div>
                    <form @submit.prevent="submit" class="row g-3">
                        <div class="col-12">
                            <label class="form-label">Nama Kategori Member</label>
                            <input type="text" class="form-control" v-model="form.name"
                                :class="{ 'is-invalid': errors.name }" placeholder="Nama Kategori Member">
                            <div v-if="errors.name" class="invalid-feedback">
                                {{ errors.name }}
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Status</label>
                            <select v-model="form.status" :class="{ 'is-invalid': errors.status }" class="form-select">
                                <option value="">[ Pilih ]</option>
                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>
                            </select>
                            <div v-if="errors.status" class="invalid-feedback">
                                {{ errors.status }}
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-sm px-5">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--end page wrapper -->
</template>

<script>
//import layout admin
import LayoutAdmin from '../../../../Layouts/Layout.vue';

// import Link
import { Link } from '@inertiajs/inertia-vue3';

//import reactive
import { reactive } from 'vue';

// import Swal
import Swal from 'sweetalert2';

// import Head from Inertia
import {
    Head
} from '@inertiajs/inertia-vue3';

import { Inertia } from '@inertiajs/inertia';


export default {
    // layout
    layout: LayoutAdmin,

    // register components
    components: {
        Link,
        Head,
    },

    //props
    props: {
        errors: Object,
    },

    // initialization composition API
    setup() {
        const form = reactive({
            name: '',
            status: '',

        });

        // submit method
        const submit = () => {
            // send data to server
            Inertia.post('/admin/member-categories', {
                // data
                name: form.name,
                status: form.status,
            }, {
                onSuccess: () => {
                    //show success alert
                    Swal.fire({
                        title: 'Success!',
                        text: 'Kategori Member Berhasil Disimpan!.',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1000
                    });
                },
            });
        }

        // return form state and submit method
        return {
            form,
            submit,
        }
    }
}
</script>
