<template>
    <Head>
        <title>{{ $page.props.setting.app_name ?? 'Atur Setting Terlebih Dahulu' }} - Tambah Program</title>
    </Head>
    <div class="page-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Program</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                            <li class="breadcrumb-item"><Link href="/admin/programs">Data Program</Link></li>
                            <li class="breadcrumb-item active" aria-current="page">Tambah Program</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="card border-top border-0 border-3 border-primary">
                <div class="card-body">
                    <form @submit.prevent="store">
                        <!-- Basic Info -->
                        <h6 class="mb-3 border-bottom pb-2"><i class="bx bx-info-circle me-1"></i> Informasi Dasar</h6>
                        <div class="row">
                            <div class="col-md-8 mb-3">
                                <label class="form-label">Nama Program <span class="text-danger">*</span></label>
                                <input type="text" v-model="form.name" class="form-control" 
                                       :class="{ 'is-invalid': errors.name }" placeholder="Nama program">
                                <div class="invalid-feedback" v-if="errors.name">{{ errors.name }}</div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Kategori <span class="text-danger">*</span></label>
                                <input type="text" v-model="form.category" class="form-control" 
                                       :class="{ 'is-invalid': errors.category }" 
                                       list="categoryList" placeholder="cth: SKD, SKB STMKG, Try Out">
                                <datalist id="categoryList">
                                    <option v-for="cat in existingCategories" :key="cat" :value="cat">{{ cat }}</option>
                                </datalist>
                                <div class="invalid-feedback" v-if="errors.category">{{ errors.category }}</div>
                            </div>
                        </div>

                        <!-- Badge & Pricing -->
                        <h6 class="mb-3 border-bottom pb-2 mt-4"><i class="bx bx-purchase-tag me-1"></i> Badge & Harga</h6>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Badge Text</label>
                                <input type="text" v-model="form.badge_text" class="form-control" 
                                       placeholder="cth: #NGEBUTBELAJAR, Recommended">
                            </div>
                            <div class="col-md-2 mb-3">
                                <label class="form-label">Badge Color</label>
                                <select v-model="form.badge_color" class="form-select">
                                    <option value="primary">Primary (Biru)</option>
                                    <option value="warning">Warning (Kuning)</option>
                                    <option value="danger">Danger (Merah)</option>
                                    <option value="success">Success (Hijau)</option>
                                    <option value="info">Info (Cyan)</option>
                                </select>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label class="form-label">Harga Asli <span class="text-danger">*</span></label>
                                <input type="number" v-model="form.original_price" class="form-control" 
                                       :class="{ 'is-invalid': errors.original_price }" min="0">
                                <div class="invalid-feedback" v-if="errors.original_price">{{ errors.original_price }}</div>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label class="form-label">Harga Promo <span class="text-danger">*</span></label>
                                <input type="number" v-model="form.promo_price" class="form-control" 
                                       :class="{ 'is-invalid': errors.promo_price }" min="0">
                                <div class="invalid-feedback" v-if="errors.promo_price">{{ errors.promo_price }}</div>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label class="form-label">Durasi</label>
                                <input type="text" v-model="form.duration" class="form-control" 
                                       placeholder="cth: /15 Sesi">
                            </div>
                        </div>

                        <!-- Alert -->
                        <h6 class="mb-3 border-bottom pb-2 mt-4"><i class="bx bx-bell me-1"></i> Alert Box</h6>
                        <div class="row">
                            <div class="col-md-8 mb-3">
                                <label class="form-label">Alert Text</label>
                                <input type="text" v-model="form.alert_text" class="form-control" 
                                       placeholder="cth: KELAS EKSKLUSIF - HANYA 10 ORANG!">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Alert Color</label>
                                <select v-model="form.alert_color" class="form-select">
                                    <option value="primary">Primary (Biru)</option>
                                    <option value="warning">Warning (Kuning)</option>
                                    <option value="danger">Danger (Merah)</option>
                                    <option value="success">Success (Hijau)</option>
                                    <option value="info">Info (Cyan)</option>
                                </select>
                            </div>
                        </div>

                        <!-- Features -->
                        <h6 class="mb-3 border-bottom pb-2 mt-4"><i class="bx bx-check-circle me-1"></i> Fitur</h6>
                        <div class="mb-3">
                            <div v-for="(feature, index) in form.features" :key="index" class="input-group mb-2">
                                <span class="input-group-text"><i class="bx bx-check text-success"></i></span>
                                <input type="text" v-model="form.features[index]" class="form-control" 
                                       placeholder="Fitur program...">
                                <button type="button" class="btn btn-outline-danger" @click="removeFeature(index)">
                                    <i class="bx bx-trash"></i>
                                </button>
                            </div>
                            <button type="button" class="btn btn-outline-primary btn-sm" @click="addFeature">
                                <i class="bx bx-plus"></i> Tambah Fitur
                            </button>
                        </div>

                        <!-- Button & Action -->
                        <h6 class="mb-3 border-bottom pb-2 mt-4"><i class="bx bx-pointer me-1"></i> Tombol Aksi</h6>
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Text Tombol <span class="text-danger">*</span></label>
                                <input type="text" v-model="form.button_text" class="form-control" 
                                       :class="{ 'is-invalid': errors.button_text }" placeholder="cth: Daftar Sekarang">
                                <div class="invalid-feedback" v-if="errors.button_text">{{ errors.button_text }}</div>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label class="form-label">Warna Tombol</label>
                                <select v-model="form.button_color" class="form-select">
                                    <option value="primary">Primary (Biru)</option>
                                    <option value="warning">Warning (Kuning)</option>
                                    <option value="danger">Danger (Merah)</option>
                                    <option value="success">Success (Hijau)</option>
                                    <option value="outline-primary">Outline Primary</option>
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Tipe Aksi <span class="text-danger">*</span></label>
                                <select v-model="form.action_type" class="form-select">
                                    <option value="whatsapp">WhatsApp (Hubungi Admin)</option>
                                    <option value="register">Register (Langsung Daftar)</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3" v-if="form.action_type === 'whatsapp'">
                                <label class="form-label">Pesan WhatsApp</label>
                                <textarea v-model="form.whatsapp_message" class="form-control" rows="2"
                                          placeholder="Pesan yang dikirim ke WhatsApp..."></textarea>
                            </div>
                        </div>

                        <!-- Status -->
                        <h6 class="mb-3 border-bottom pb-2 mt-4"><i class="bx bx-cog me-1"></i> Pengaturan</h6>
                        <div class="row">
                            <div class="col-md-2 mb-3">
                                <label class="form-label">Urutan</label>
                                <input type="number" v-model="form.order" class="form-control" min="0">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Status</label>
                                <div class="form-check form-switch mt-2">
                                    <input class="form-check-input" type="checkbox" v-model="form.is_active">
                                    <label class="form-check-label">{{ form.is_active ? 'Aktif' : 'Nonaktif' }}</label>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Featured</label>
                                <div class="form-check form-switch mt-2">
                                    <input class="form-check-input" type="checkbox" v-model="form.is_featured">
                                    <label class="form-check-label">{{ form.is_featured ? 'Ya' : 'Tidak' }}</label>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex gap-2 mt-4">
                            <button type="submit" class="btn btn-primary" :disabled="isSubmitting">
                                <span v-if="isSubmitting" class="spinner-border spinner-border-sm me-1"></span>
                                Simpan
                            </button>
                            <Link href="/admin/programs" class="btn btn-secondary">Kembali</Link>
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
    props: {
        existingCategories: Array
    },
    setup() {
        const page = usePage();
        const errors = computed(() => page.props.value.errors);
        const isSubmitting = ref(false);

        const form = reactive({
            name: '',
            category: '',
            badge_text: '',
            badge_color: 'primary',
            original_price: 0,
            promo_price: 0,
            duration: '',
            alert_text: '',
            alert_color: 'primary',
            features: [''],
            button_text: 'Daftar Sekarang',
            button_color: 'primary',
            whatsapp_message: '',
            action_type: 'whatsapp',
            is_featured: false,
            is_active: true,
            order: 0,
        });

        const addFeature = () => {
            form.features.push('');
        };

        const removeFeature = (index) => {
            form.features.splice(index, 1);
        };

        const store = () => {
            isSubmitting.value = true;
            // Filter empty features
            const filteredFeatures = form.features.filter(f => f.trim() !== '');
            const submitData = { ...form, features: filteredFeatures };

            Inertia.post('/admin/programs', submitData, {
                onFinish: () => {
                    isSubmitting.value = false;
                }
            });
        };

        return { form, errors, isSubmitting, addFeature, removeFeature, store };
    }
};
</script>
