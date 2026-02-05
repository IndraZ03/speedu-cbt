<template>
    <Head>
        <title>{{ $page.props.setting.app_name ?? 'Atur Setting Terlebih Dahulu' }} - Tambah Testimoni</title>
    </Head>
    <div class="page-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Testimoni</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                            <li class="breadcrumb-item"><Link href="/admin/testimonials">Data Testimoni</Link></li>
                            <li class="breadcrumb-item active" aria-current="page">Tambah Testimoni</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="card border-top border-0 border-3 border-primary">
                <div class="card-body">
                    <form @submit.prevent="store" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama <span class="text-danger">*</span></label>
                                <input type="text" v-model="form.name" class="form-control" 
                                       :class="{ 'is-invalid': errors.name }" placeholder="Nama pelanggan">
                                <div class="invalid-feedback" v-if="errors.name">{{ errors.name }}</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Posisi</label>
                                <input type="text" v-model="form.position" class="form-control" 
                                       :class="{ 'is-invalid': errors.position }" placeholder="cth: Siswa STMKG 2025">
                                <div class="invalid-feedback" v-if="errors.position">{{ errors.position }}</div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Testimoni <span class="text-danger">*</span></label>
                            <textarea v-model="form.content" class="form-control" rows="4"
                                      :class="{ 'is-invalid': errors.content }" 
                                      placeholder="Isi testimoni pelanggan"></textarea>
                            <div class="invalid-feedback" v-if="errors.content">{{ errors.content }}</div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Foto</label>
                                <input type="file" @change="handleFileUpload" class="form-control" 
                                       :class="{ 'is-invalid': errors.photo }" accept="image/*">
                                <div class="invalid-feedback" v-if="errors.photo">{{ errors.photo }}</div>
                                <div v-if="previewUrl" class="mt-2">
                                    <img :src="previewUrl" class="rounded" width="80" height="80" style="object-fit: cover;">
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Rating <span class="text-danger">*</span></label>
                                <select v-model="form.rating" class="form-select" :class="{ 'is-invalid': errors.rating }">
                                    <option value="5">⭐⭐⭐⭐⭐ (5)</option>
                                    <option value="4">⭐⭐⭐⭐ (4)</option>
                                    <option value="3">⭐⭐⭐ (3)</option>
                                    <option value="2">⭐⭐ (2)</option>
                                    <option value="1">⭐ (1)</option>
                                </select>
                                <div class="invalid-feedback" v-if="errors.rating">{{ errors.rating }}</div>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label class="form-label">Urutan</label>
                                <input type="number" v-model="form.order" class="form-control" min="0">
                            </div>
                            <div class="col-md-2 mb-3">
                                <label class="form-label">Status</label>
                                <div class="form-check form-switch mt-2">
                                    <input class="form-check-input" type="checkbox" v-model="form.is_active">
                                    <label class="form-check-label">{{ form.is_active ? 'Aktif' : 'Nonaktif' }}</label>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary" :disabled="isSubmitting">
                                <span v-if="isSubmitting" class="spinner-border spinner-border-sm me-1"></span>
                                Simpan
                            </button>
                            <Link href="/admin/testimonials" class="btn btn-secondary">Kembali</Link>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import LayoutAdmin from '../../../Layouts/Layout.vue';
import { Link, Head } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';
import { ref, reactive, computed } from 'vue';
import { usePage } from '@inertiajs/inertia-vue3';

export default {
    layout: LayoutAdmin,
    components: { Link, Head },
    setup() {
        const page = usePage();
        const errors = computed(() => page.props.value.errors);
        const isSubmitting = ref(false);
        const previewUrl = ref(null);

        const form = reactive({
            name: '',
            position: '',
            content: '',
            photo: null,
            rating: 5,
            is_active: true,
            order: 0,
        });

        const handleFileUpload = (event) => {
            const file = event.target.files[0];
            if (file) {
                form.photo = file;
                previewUrl.value = URL.createObjectURL(file);
            }
        };

        const store = () => {
            isSubmitting.value = true;
            const formData = new FormData();
            Object.keys(form).forEach(key => {
                if (form[key] !== null) {
                    if (key === 'is_active') {
                        formData.append(key, form[key] ? 1 : 0);
                    } else {
                        formData.append(key, form[key]);
                    }
                }
            });

            Inertia.post('/admin/testimonials', formData, {
                onFinish: () => {
                    isSubmitting.value = false;
                }
            });
        };

        return { form, errors, isSubmitting, previewUrl, handleFileUpload, store };
    }
};
</script>
