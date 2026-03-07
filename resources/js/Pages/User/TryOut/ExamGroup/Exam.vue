<template>
    <Head>
        <title>{{ $page.props.setting.app_name ?? 'Atur Setting Terlebih Dahulu' }} - Try Out</title>
    </Head>
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!-- Modern Header -->
            <div class="exam-header mb-4">
                <div class="header-card">
                    <div class="header-content">
                        <div class="header-text">
                            <Link :href="`/user/exam-groups/${lessonCategory.category_id}/lesson-categories`" class="back-link">
                                <i class="bx bx-arrow-back"></i>
                            </Link>
                            <div>
                                <h4 class="header-title">Soal Try Out</h4>
                                <p class="header-subtitle">{{ lessonCategory.name }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="header-decoration">
                        <div class="floating-circle c1"></div>
                        <div class="floating-circle c2"></div>
                    </div>
                </div>
            </div>

            <!-- Alert Messages -->
            <div class="row" v-if="$page.props.session.failed || $page.props.session.error || $page.props.session.success">
                <div class="col-lg-12 mb-3">
                    <div v-if="$page.props.session.failed" class="alert alert-danger border-0 alert-modern">
                        <i class="bx bx-error-circle me-2"></i>
                        <div v-html="$page.props.session.failed"></div>
                    </div>
                    <div v-if="$page.props.session.error" class="alert alert-danger border-0 alert-modern">
                        <i class="bx bx-error-circle me-2"></i>
                        <div v-html="$page.props.session.error"></div>
                    </div>
                    <div v-if="$page.props.session.success" class="alert alert-success border-0 alert-modern">
                        <i class="bx bx-check-circle me-2"></i>
                        <div v-html="$page.props.session.success"></div>
                    </div>
                </div>
            </div>

            <!-- Empty State -->
            <div v-if="!examGroups.data.length" class="empty-state-card">
                <div class="empty-icon">
                    <i class="bx bx-file"></i>
                </div>
                <h5>Soal Belum Tersedia</h5>
                <p>Silakan hubungi admin untuk informasi lebih lanjut</p>
            </div>

            <!-- Exam Grid -->
            <div class="exam-grid">
                <div class="exam-card-modern" v-for="(exam, index) in examGroups.data" :key="index">
                    <div class="exam-card-wrapper">
                        <!-- Purchased Badge -->
                        <div v-if="$page.props.auth.user.member_type == 2">
                            <div v-if="(exam.transaction.length > 0 || checkMemberCategories(exam.member_categories) == true) && exam.member_categories" class="purchased-badge">
                                <i class="bx bx-check-circle"></i>
                            </div>
                        </div>
                        
                        <!-- Thumbnail -->
                        <div class="exam-thumbnail">
                            <img v-bind:src="'/storage/upload_files/lesson_categories/' + exam.lesson_category.thumbnail" :alt="exam.title" />
                            <div class="thumbnail-overlay"></div>
                        </div>

                        <!-- Content -->
                        <div class="exam-content">
                            <h6 class="exam-title">{{ exam.title }}</h6>
                            
                            <!-- Price Section -->
                            <div v-if="$page.props.auth.user.member_type == 2" class="price-section">
                                <div v-if="($page.props.setting.purchase_type == 1 || $page.props.setting.purchase_type == 3)">
                                    <div v-if="exam.price_before_discount == exam.price_after_discount" class="current-price">
                                        Rp {{ formatPrice(exam.price_after_discount) }}
                                    </div>
                                    <div v-else class="price-discount">
                                        <span class="original-price">Rp {{ formatPrice(exam.price_before_discount) }}</span>
                                        <span class="discount-badge">{{ formatPrice((exam.price_before_discount - exam.price_after_discount) / exam.price_before_discount * 100) }}% OFF</span>
                                        <div class="current-price">Rp {{ formatPrice(exam.price_after_discount) }}</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Member Categories -->
                            <div v-if="$page.props.auth.user.member_type == 2 && ($page.props.setting.purchase_type == 2 || $page.props.setting.purchase_type == 3)">
                                <div v-if="exam.member_categories" class="member-badges">
                                    <span v-for="(memberCategory, idx) in exam.member_categories" :key="idx" class="member-badge">
                                        {{ memberCategory }}
                                    </span>
                                </div>
                                <div v-else class="member-badges">
                                    <span class="member-badge all-access">Semua Member</span>
                                </div>
                            </div>
                        </div>

                        <!-- Footer Actions -->
                        <div class="exam-footer">
                            <div v-if="exam.exam_status == 'active'">
                                <div v-if="$page.props.auth.user.member_type == 2">
                                    <!-- Purchase Type 1 -->
                                    <div v-if="$page.props.setting.purchase_type == 1">
                                        <div v-if="exam.transaction.length > 0">
                                            <Link :href="`/user/exam-groups/${lessonCategory.category_id}/lesson-categories/${lessonCategory.id}/exams/${exam.id}`" class="btn-action btn-primary-gradient">
                                                <i class="bx bx-play-circle"></i>
                                                Kerjakan Try Out
                                            </Link>
                                        </div>
                                        <div v-else>
                                            <button class="btn-action btn-buy" @click="buyExam(exam.id)">
                                                <i class="bx bx-cart-add"></i>
                                                Beli Try Out
                                            </button>         
                                        </div>
                                    </div>
                                    
                                    <!-- Purchase Type 2 -->
                                    <div v-if="$page.props.setting.purchase_type == 2">
                                        <div v-if="checkMemberCategories(exam.member_categories) == true">
                                            <Link :href="`/user/exam-groups/${lessonCategory.category_id}/lesson-categories/${lessonCategory.id}/exams/${exam.id}`" class="btn-action btn-primary-gradient">
                                                <i class="bx bx-play-circle"></i>
                                                Kerjakan Try Out
                                            </Link>
                                        </div>
                                        <div v-else>
                                            <Link :href="`/user/vouchers?category_id=${exam.category_id}`" class="btn-action btn-upgrade">
                                                <i class="bx bx-crown"></i>
                                                <div v-if="exam.member_categories.length == 1">
                                                    Upgrade Ke {{ exam.member_categories[0] }}
                                                </div>
                                                <div v-else>
                                                    Upgrade Member
                                                </div>
                                            </Link> 
                                        </div>
                                    </div>     

                                    <!-- Purchase Type 3 -->
                                    <div v-if="$page.props.setting.purchase_type == 3" class="action-buttons">
                                        <div v-if="exam.transaction.length > 0 && checkMemberCategories(exam.member_categories) == true">
                                            <Link :href="`/user/exam-groups/${lessonCategory.category_id}/lesson-categories/${lessonCategory.id}/exams/${exam.id}`" class="btn-action btn-primary-gradient">
                                                <i class="bx bx-play-circle"></i>
                                                Kerjakan Try Out
                                            </Link>
                                        </div>

                                        <div v-if="(exam.transaction.length == 0 || checkMemberCategories(exam.member_categories) == false) && (exam.transaction.length > 0 || checkMemberCategories(exam.member_categories) == true)">
                                            <Link :href="`/user/exam-groups/${lessonCategory.category_id}/lesson-categories/${lessonCategory.id}/exams/${exam.id}`" class="btn-action btn-primary-gradient mb-2">
                                                <i class="bx bx-play-circle"></i>
                                                Kerjakan Try Out
                                            </Link>
                                        </div>

                                        <div v-if="exam.transaction.length == 0">
                                            <button class="btn-action btn-buy mb-2" @click="buyExam(exam.id)">
                                                <i class="bx bx-cart-add"></i>
                                                Beli Try Out
                                            </button>       
                                        </div>

                                        <div v-if="checkMemberCategories(exam.member_categories) == false">
                                            <Link :href="`/user/vouchers?category_id=${exam.category_id}`" class="btn-action btn-upgrade">
                                                <i class="bx bx-crown"></i>
                                                <div v-if="exam.member_categories.length == 1">
                                                    Upgrade Ke {{ exam.member_categories[0] }}
                                                </div>
                                                <div v-else>
                                                    Upgrade Member
                                                </div>
                                            </Link>      
                                        </div>
                                    </div>   
                                </div>
                                <div v-else>
                                    <Link :href="`/user/exam-groups/${lessonCategory.category_id}/lesson-categories/${lessonCategory.id}/exams/${exam.id}`" class="btn-action btn-primary-gradient">
                                        <i class="bx bx-play-circle"></i>
                                        Kerjakan Try Out
                                    </Link>
                                </div>
                            </div>
                            <div v-else>
                                <button class="btn-action btn-status" :class="{ 'btn-inactive': exam.exam_status == 'inactive', 'btn-progress': exam.exam_status === 'inprogress'}">
                                    <i class="bx" :class="{ 'bx-x-circle': exam.exam_status == 'inactive', 'bx-loader-circle bx-spin': exam.exam_status === 'inprogress'}"></i>
                                    {{ exam.exam_status === 'inactive' ? 'Non Active' : 'In Progress' }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            <div class="row mt-4" v-if="examGroups.data.length">
                <div class="col text-center">
                    <Pagination :links="examGroups.links" align="center" />
                </div>
            </div>
        </div>
    </div>
    <!--end page wrapper -->
</template>

<script>
import LayoutUser from '../../../../Layouts/Layout.vue';
import Pagination from '../../../../Components/Pagination.vue';
import { Link } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';
import Swal from 'sweetalert2';
import { Head } from '@inertiajs/inertia-vue3';

export default {
    layout: LayoutUser,
    components: {
        Link,
        Head,
        Pagination
    },
    props: {
        examGroups: Object,
        lessonCategory: Object,
        userMemberCategories: Object,
    },
    setup(props) {
        const buyExam = (examId) => {
            Swal.fire({
                title: 'Yakin akan membeli Try Out?',
                text: "Pastikan Saldo Anda Cukup Untuk Transaksi",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#1477F5',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Beli Try Out',
                cancelButtonText: 'Tidak'
            })
            .then((result) => {
                if (result.isConfirmed) {
                    Inertia.get(`/user/account-balances/buy-exam/${examId}?type=examGroup`);
                }
            })
        }

        const checkMemberCategories = (categories) => {
            if(categories) {
                for (const entry of props.userMemberCategories) {
                    if (entry.member_categories.some(category => categories.includes(category))) {
                    return true;
                    }
                }
                return false;
            } else {
                return true;
            }
        }

        return {
            buyExam,
            checkMemberCategories
        }
    },
    methods: {
        formatPrice(value) {
            let val = (value/1).toFixed().replace('.', ',')
            return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        }
    }
}
</script>

<style scoped>
/* Header Styles */
.exam-header {
    margin-bottom: 2rem;
}

.header-card {
    background: linear-gradient(135deg, #1477F5 0%, #0d5cbf 100%);
    border-radius: 20px;
    padding: 2rem;
    position: relative;
    overflow: hidden;
    box-shadow: 0 10px 40px rgba(20, 119, 245, 0.3);
}

.header-content {
    position: relative;
    z-index: 2;
}

.header-text {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.back-link {
    width: 45px;
    height: 45px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 1.5rem;
    text-decoration: none;
    transition: all 0.3s ease;
}

.back-link:hover {
    background: rgba(255, 255, 255, 0.3);
    transform: translateX(-5px);
}

.header-title {
    color: #fff;
    font-weight: 700;
    margin: 0;
}

.header-subtitle {
    color: #F8C62C;
    margin: 0.25rem 0 0;
    font-size: 0.9rem;
    font-weight: 500;
}

.header-decoration {
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    width: 200px;
}

.floating-circle {
    position: absolute;
    border-radius: 50%;
    background: rgba(248, 198, 44, 0.2);
}

.c1 { width: 150px; height: 150px; top: -50px; right: -50px; }
.c2 { width: 100px; height: 100px; bottom: -30px; right: 50px; }

/* Empty State */
.empty-state-card {
    background: #fff;
    border-radius: 20px;
    padding: 3rem;
    text-align: center;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
}

.empty-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #f3f4f6, #e5e7eb);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
    font-size: 2.5rem;
    color: #9ca3af;
}

.empty-state-card h5 { color: #374151; margin-bottom: 0.5rem; }
.empty-state-card p { color: #9ca3af; margin: 0; }

/* Alert Modern */
.alert-modern {
    display: flex;
    align-items: flex-start;
    border-radius: 12px;
    padding: 1rem 1.5rem;
}

.alert-modern i { font-size: 1.25rem; flex-shrink: 0; }

/* Exam Grid */
.exam-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 1.5rem;
}

.exam-card-modern {
    height: 100%;
}

.exam-card-wrapper {
    background: #fff;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
    height: 100%;
    display: flex;
    flex-direction: column;
    position: relative;
}

.exam-card-wrapper:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
}

/* Purchased Badge */
.purchased-badge {
    position: absolute;
    top: 15px;
    right: 15px;
    width: 35px;
    height: 35px;
    background: linear-gradient(135deg, #10b981, #059669);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 1.25rem;
    z-index: 10;
    box-shadow: 0 4px 10px rgba(16, 185, 129, 0.4);
}

/* Thumbnail */
.exam-thumbnail {
    position: relative;
    height: 150px;
    overflow: hidden;
}

.exam-thumbnail img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.exam-card-wrapper:hover .exam-thumbnail img {
    transform: scale(1.1);
}

.thumbnail-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 50%;
    background: linear-gradient(to top, rgba(0, 0, 0, 0.3), transparent);
}

/* Content */
.exam-content {
    padding: 1.25rem;
    flex: 1;
}

.exam-title {
    color: #1f2937;
    font-weight: 600;
    margin-bottom: 1rem;
    line-height: 1.4;
}

/* Price Section */
.price-section {
    margin-bottom: 1rem;
}

.current-price {
    color: #1477F5;
    font-size: 1.25rem;
    font-weight: 700;
}

.price-discount {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}

.original-price {
    color: #9ca3af;
    text-decoration: line-through;
    font-size: 0.85rem;
}

.discount-badge {
    display: inline-block;
    background: linear-gradient(135deg, #ef4444, #dc2626);
    color: #fff;
    padding: 0.25rem 0.5rem;
    border-radius: 6px;
    font-size: 0.7rem;
    font-weight: 600;
    width: fit-content;
}

/* Member Badges */
.member-badges {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
}

.member-badge {
    background: linear-gradient(135deg, #10b981, #059669);
    color: #fff;
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 500;
}

.member-badge.all-access {
    background: linear-gradient(135deg, #1477F5, #0d5cbf);
}

/* Footer */
.exam-footer {
    padding: 1.25rem;
    border-top: 1px solid #f3f4f6;
}

.btn-action {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    width: 100%;
    padding: 0.75rem;
    border-radius: 12px;
    font-weight: 600;
    text-decoration: none;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 0.9rem;
}

.btn-primary-gradient {
    background: linear-gradient(135deg, #1477F5 0%, #0d5cbf 100%);
    color: #fff;
}

.btn-primary-gradient:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(20, 119, 245, 0.4);
    color: #fff;
}

.btn-buy {
    background: linear-gradient(135deg, #F8C62C, #e5b526);
    color: #1f2937;
}

.btn-buy:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(248, 198, 44, 0.4);
}

.btn-upgrade {
    background: linear-gradient(135deg, #8b5cf6, #7c3aed);
    color: #fff;
}

.btn-upgrade:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(139, 92, 246, 0.4);
    color: #fff;
}

.btn-status {
    cursor: not-allowed;
}

.btn-inactive {
    background: #fee2e2;
    color: #dc2626;
}

.btn-progress {
    background: #fef3c7;
    color: #d97706;
}

.action-buttons > div:not(:last-child) {
    margin-bottom: 0.5rem;
}

/* Responsive */
@media (max-width: 768px) {
    .header-card { padding: 1.5rem; }
    .exam-grid { grid-template-columns: 1fr; }
}
</style>
