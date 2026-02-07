<template>
    <Head>
        <title>{{ $page.props.setting.app_name ?? 'SpeedU CBT' }} - Review Try Out</title>
    </Head>
    <div class="page-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Review Try Out</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Review & Keluhan</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body text-center">
                            <div class="stats-icon bg-primary bg-opacity-10 text-primary mx-auto mb-2">
                                <i class="bx bx-message-square-dots"></i>
                            </div>
                            <h3 class="mb-0">{{ stats.total }}</h3>
                            <p class="text-muted mb-0">Total Review</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body text-center">
                            <div class="stats-icon bg-warning bg-opacity-10 text-warning mx-auto mb-2">
                                <i class="bx bx-envelope"></i>
                            </div>
                            <h3 class="mb-0">{{ stats.unread }}</h3>
                            <p class="text-muted mb-0">Belum Dibaca</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body text-center">
                            <div class="stats-icon bg-danger bg-opacity-10 text-danger mx-auto mb-2">
                                <i class="bx bx-error-circle"></i>
                            </div>
                            <h3 class="mb-0">{{ stats.complaints }}</h3>
                            <p class="text-muted mb-0">Keluhan</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body text-center">
                            <div class="stats-icon bg-success bg-opacity-10 text-success mx-auto mb-2">
                                <i class="bx bx-star"></i>
                            </div>
                            <h3 class="mb-0">{{ stats.average_rating || 0 }}</h3>
                            <p class="text-muted mb-0">Rating Rata-rata</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border-top border-0 border-3 border-primary">
                <div class="card-body">
                    <!-- Filters -->
                    <div class="d-lg-flex align-items-center mb-4 gap-3 flex-wrap">
                        <form @submit.prevent="handleSearch" class="d-flex gap-2 flex-wrap">
                            <div class="position-relative">
                                <input
                                    type="text"
                                    v-model="search"
                                    class="form-control ps-5 radius-20"
                                    placeholder="Cari nama user atau try out..."
                                    size="30"
                                    maxlength="100"
                                >
                                <span class="position-absolute top-50 product-show translate-middle-y">
                                    <i class="bx bx-search"></i>
                                </span>
                            </div>
                            <select v-model="filterRating" class="form-select" style="width: auto;">
                                <option value="">Semua Rating</option>
                                <option v-for="r in 5" :key="r" :value="r">{{ r }} Bintang</option>
                            </select>
                            <select v-model="filterComplaint" class="form-select" style="width: auto;">
                                <option value="">Semua</option>
                                <option value="1">Ada Keluhan</option>
                            </select>
                            <select v-model="filterRead" class="form-select" style="width: auto;">
                                <option value="">Semua Status</option>
                                <option value="0">Belum Dibaca</option>
                                <option value="1">Sudah Dibaca</option>
                            </select>
                            <button type="submit" class="btn btn-primary">
                                <i class="bx bx-filter-alt"></i> Filter
                            </button>
                        </form>
                        <div class="ms-auto d-flex gap-2 mt-2 mt-lg-0">
                            <button @click="markAllRead" class="btn btn-outline-success btn-sm" :disabled="stats.unread === 0">
                                <i class="bx bx-check-double"></i> Tandai Semua Dibaca
                            </button>
                        </div>
                    </div>

                    <!-- Reviews List -->
                    <div class="reviews-list">
                        <div v-for="(review, index) in reviews.data" :key="review.id" 
                             class="review-item p-3 mb-3 rounded-3"
                             :class="{ 'unread': !review.is_read }">
                            <div class="d-flex align-items-start gap-3">
                                <!-- Avatar -->
                                <div class="review-avatar">
                                    {{ review.user?.name?.charAt(0).toUpperCase() || 'U' }}
                                </div>
                                
                                <!-- Content -->
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <div>
                                            <h6 class="mb-0 fw-bold">{{ review.user?.name || 'User' }}</h6>
                                            <small class="text-muted">
                                                {{ review.exam_group?.title || 'Try Out' }} • 
                                                {{ formatDate(review.created_at) }}
                                            </small>
                                        </div>
                                        <div class="d-flex gap-2 align-items-center">
                                            <!-- Rating Stars -->
                                            <div class="rating-stars">
                                                <span v-for="star in 5" :key="star">
                                                    <i :class="star <= review.rating ? 'bx bxs-star text-warning' : 'bx bx-star text-muted'"></i>
                                                </span>
                                            </div>
                                            <!-- Badges -->
                                            <span v-if="!review.is_read" class="badge bg-warning">Baru</span>
                                            <span v-if="review.has_complaint" class="badge bg-danger">Keluhan</span>
                                        </div>
                                    </div>
                                    
                                    <!-- Review Text -->
                                    <div v-if="review.review" class="review-text mb-2">
                                        <p class="mb-0">{{ review.review }}</p>
                                    </div>
                                    
                                    <!-- Complaint -->
                                    <div v-if="review.has_complaint && review.complaint" class="complaint-box p-2 rounded bg-danger bg-opacity-10 mb-2">
                                        <small class="text-danger fw-bold"><i class="bx bx-error-circle"></i> Keluhan:</small>
                                        <p class="mb-0 small text-dark">{{ review.complaint }}</p>
                                    </div>
                                    
                                    <!-- Actions -->
                                    <div class="d-flex gap-2 mt-2">
                                        <button v-if="!review.is_read" 
                                                @click="markAsRead(review.id)" 
                                                class="btn btn-sm btn-outline-success">
                                            <i class="bx bx-check"></i> Tandai Dibaca
                                        </button>
                                        <button @click="destroy(review.id)" class="btn btn-sm btn-outline-danger">
                                            <i class="bx bx-trash"></i> Hapus
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Empty State -->
                        <div v-if="!reviews.data.length" class="text-center py-5">
                            <i class="bx bx-message-square-dots text-muted" style="font-size: 4rem;"></i>
                            <p class="text-muted mt-3">Belum ada review</p>
                        </div>
                    </div>

                    <Pagination :links="reviews.links" align="end" />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import LayoutAdmin from '../../../Layouts/Layout.vue';
import Pagination from '../../../Components/Pagination.vue';
import { Link, Head } from '@inertiajs/inertia-vue3';
import Swal from 'sweetalert2';
import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';

export default {
    layout: LayoutAdmin,
    components: { Link, Head, Pagination },
    props: {
        reviews: Object,
        stats: Object,
        filters: Object
    },
    setup(props) {
        const search = ref(props.filters?.search || '');
        const filterRating = ref(props.filters?.rating || '');
        const filterComplaint = ref(props.filters?.has_complaint || '');
        const filterRead = ref(props.filters?.is_read || '');

        const handleSearch = () => {
            Inertia.get('/admin/exam-reviews', {
                search: search.value,
                rating: filterRating.value,
                has_complaint: filterComplaint.value,
                is_read: filterRead.value
            });
        };

        const formatDate = (date) => {
            if (!date) return '';
            return new Date(date).toLocaleDateString('id-ID', {
                day: 'numeric',
                month: 'short',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            });
        };

        const markAsRead = (id) => {
            Inertia.post(`/admin/exam-reviews/${id}/read`, {}, {
                preserveScroll: true
            });
        };

        const markAllRead = () => {
            Swal.fire({
                title: 'Tandai Semua Dibaca?',
                text: "Semua review akan ditandai sudah dibaca",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Tandai Semua'
            }).then((result) => {
                if (result.isConfirmed) {
                    Inertia.post('/admin/exam-reviews/read-all', {}, {
                        preserveScroll: true,
                        onSuccess: () => {
                            Swal.fire({
                                title: 'Berhasil!',
                                text: 'Semua review ditandai sudah dibaca',
                                icon: 'success',
                                timer: 1000,
                                showConfirmButton: false
                            });
                        }
                    });
                }
            });
        };

        const destroy = (id) => {
            Swal.fire({
                title: 'Hapus Review?',
                text: "Review ini akan dihapus permanen",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Hapus'
            }).then((result) => {
                if (result.isConfirmed) {
                    Inertia.delete(`/admin/exam-reviews/${id}`, {
                        preserveScroll: true,
                        onSuccess: () => {
                            Swal.fire({
                                title: 'Dihapus!',
                                text: 'Review berhasil dihapus',
                                icon: 'success',
                                timer: 1000,
                                showConfirmButton: false
                            });
                        }
                    });
                }
            });
        };

        return { 
            search, 
            filterRating,
            filterComplaint,
            filterRead,
            handleSearch, 
            formatDate,
            markAsRead,
            markAllRead,
            destroy 
        };
    }
};
</script>

<style scoped>
.stats-icon {
    width: 50px;
    height: 50px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
}

.review-item {
    background: #f8f9fa;
    border-left: 4px solid #dee2e6;
    transition: all 0.2s;
}

.review-item.unread {
    background: #fff3cd;
    border-left-color: #ffc107;
}

.review-item:hover {
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.review-avatar {
    width: 45px;
    height: 45px;
    border-radius: 12px;
    background: linear-gradient(135deg, #1477F5, #0d5cbf);
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 1.1rem;
    flex-shrink: 0;
}

.rating-stars i {
    font-size: 1rem;
}

.complaint-box {
    border-left: 3px solid #dc3545;
}
</style>
