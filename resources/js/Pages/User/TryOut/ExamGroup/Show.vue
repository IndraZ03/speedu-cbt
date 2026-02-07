<template>
    <Head>
        <title>{{ $page.props.setting.app_name ?? 'Atur Setting Terlebih Dahulu' }} - Try Out</title>
    </Head>
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!-- Modern Header -->
            <div class="section-header mb-4">
                <div class="header-card">
                    <div class="header-content">
                        <div class="header-text">
                            <Link :href="`/user/exam-groups/${lessonCategory.category_id}/lesson-categories/${lessonCategory.id}/exams`" class="back-link">
                                <i class="bx bx-arrow-back"></i>
                            </Link>
                            <div>
                                <h4 class="header-title">{{ examGroup.title }}</h4>
                                <p class="header-subtitle">
                                    <span class="badge-category">{{ examGroup.category.name }}</span>
                                    <span class="badge-lesson">{{ examGroup.lesson_category.name }}</span>
                                </p>
                            </div>
                        </div>
                        <Link href="/user/exam-groups/histories" class="history-btn">
                            <i class="bx bx-history"></i>
                            Riwayat Try Out
                        </Link>
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

            <div class="row">
                <!-- Participant Info Card -->
                <div class="col-lg-4 mb-4">
                    <div class="info-card participant-card">
                        <div class="card-header-modern">
                            <div class="header-icon bg-gradient-blue">
                                <i class="bx bx-user"></i>
                            </div>
                            <h5 class="card-title-modern">Data Peserta</h5>
                        </div>
                        <div class="card-body-modern">
                            <div class="participant-avatar">
                                <span class="avatar-text">{{ $page.props.auth.user.name.charAt(0).toUpperCase() }}</span>
                            </div>
                            <h5 class="participant-name">{{ $page.props.auth.user.name }}</h5>
                            <p class="participant-email">{{ $page.props.auth.user.email ?? '-' }}</p>
                            
                            <div class="info-list">
                                <div class="info-item">
                                    <span class="info-label">Peminatan</span>
                                    <span class="info-value">
                                        <span class="badge-primary">{{ examGroup.category.name }}</span>
                                    </span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Kategori</span>
                                    <span class="info-value">
                                        <span class="badge-success">{{ examGroup.lesson_category.name }}</span>
                                    </span>
                                </div>
                                <div class="info-item" v-if="$page.props.auth.user.member_type == 2">
                                    <span class="info-label">Akses Member</span>
                                    <span class="info-value">
                                        <span v-if="examGroup.member_categories" v-for="(mc, idx) in examGroup.member_categories" :key="idx" class="badge-success me-1">
                                            {{ mc }}
                                        </span>
                                        <span v-else class="badge-success">Semua Member</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Exam Sections Card -->
                <div class="col-lg-8 mb-4">
                    <div class="info-card sections-card">
                        <div class="card-header-modern">
                            <div class="header-icon bg-gradient-yellow">
                                <i class="bx bx-book-open"></i>
                            </div>
                            <h5 class="card-title-modern">Detail Soal</h5>
                        </div>
                        <div class="card-body-modern">
                            <!-- Exam Type 2 (Individual exams with sections) -->
                            <div v-if="examGroup.exam_group_type == 2" class="sections-list">
                                <div v-if="!examGroup.exam.length" class="empty-sections">
                                    <i class="bx bx-file"></i>
                                    <p>Data Tidak Tersedia</p>
                                </div>
                                <div v-else v-for="(exam, index) in examGroup.exam" :key="index" class="section-item">
                                    <div class="section-number">{{ index + 1 }}</div>
                                    <div class="section-content">
                                        <h6 class="section-title">{{ exam.title }}</h6>
                                        <div class="section-meta">
                                            <span class="meta-item">
                                                <i class="bx bx-time-five"></i>
                                                {{ exam.duration }} Menit {{ exam.question_title.total_section > 1 ? '/ Kolom (total '+ exam.question_title.total_section +' Kolom)' : '' }}
                                            </span>
                                        </div>
                                        
                                        <!-- Question Progress -->
                                        <div class="question-progress" v-if="exam.grade && exam.grade[0]">
                                            <div class="progress-label">
                                                <span>Soal Dijawab</span>
                                                <span class="progress-value">
                                                    {{ getAnsweredCount(exam) }} / {{ getTotalQuestions(exam) }}
                                                </span>
                                            </div>
                                            <div class="progress-bar-wrapper">
                                                <div class="progress-bar-fill" :style="{ width: getProgressPercentage(exam) + '%' }"></div>
                                            </div>
                                            <div class="progress-stats">
                                                <span class="stat-answered">
                                                    <i class="bx bx-check-circle"></i>
                                                    {{ getAnsweredCount(exam) }} Terjawab
                                                </span>
                                                <span class="stat-unanswered">
                                                    <i class="bx bx-x-circle"></i>
                                                    {{ getUnansweredCount(exam) }} Belum Dijawab
                                                </span>
                                            </div>
                                        </div>

                                        <!-- Status Badge -->
                                        <div class="section-status">
                                            <div v-if="!exam.grade[0]">
                                                <span class="status-badge status-pending">
                                                    <i class="bx bx-time-five"></i>
                                                    Belum Mengerjakan
                                                </span>
                                            </div>
                                            <div v-else-if="exam.grade[0] && exam.grade[0].is_finished == 0">
                                                <span class="status-badge status-progress">
                                                    <i class="bx bx-loader-circle"></i>
                                                    Sedang Dikerjakan
                                                </span>
                                            </div>
                                            <div v-else-if="exam.grade[0] && exam.grade[0].is_finished == 1">
                                                <span class="status-badge status-done">
                                                    <i class="bx bx-check-double"></i>
                                                    Sudah Selesai
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="section-actions">
                                        <span class="action-badge action-inactive" v-if="exam.exam_status == 'inprogress' || examGroup.exam_status == 'inprogress'">
                                            <i class="bx bx-loader-circle bx-spin"></i>
                                            In Progress
                                        </span>
                                        <span class="action-badge action-inactive" v-else-if="exam.exam_status == 'inactive' || examGroup.exam_status == 'inactive'">
                                            <i class="bx bx-x-circle"></i>
                                            Tidak Aktif
                                        </span>
                                        <div v-else-if="exam.exam_status == 'active' && examGroup.exam_status == 'active'" class="action-buttons">
                                            <div v-if="!exam.grade[0]">
                                                <Link :href="`/user/exams/${exam.id}/exam-start`" class="btn-action btn-start">
                                                    <i class="bx bx-play"></i>
                                                    Mulai
                                                </Link>
                                            </div>
                                            <div v-else-if="exam.grade[0] && exam.grade[0].is_finished == 0">
                                                <Link :href="`/user/exams/${exam.id}/exam-start`" class="btn-action btn-continue">
                                                    <i class="bx bx-right-arrow-alt"></i>
                                                    Lanjut
                                                </Link>
                                            </div>
                                            <div v-else-if="exam.grade[0] && exam.grade[0].is_finished == 1" class="done-actions">
                                                <a href="#" @click.prevent="repeatExam(exam.id)" class="btn-action btn-repeat" v-if="exam.repeat_the_exam == 1">
                                                    <i class="bx bx-refresh"></i>
                                                    Ulangi
                                                </a>
                                                <Link :href="`/user/grades/${exam.grade[0].id}`" class="btn-action btn-result">
                                                    <i class="bx bx-bar-chart-alt-2"></i>
                                                    Hasil
                                                </Link>
                                                <Link :href="`/user/grades/${exam.grade[0].id}/questions`" v-if="exam.show_answer_discussion == 1" class="btn-action btn-discuss">
                                                    <i class="bx bx-message-dots"></i>
                                                    Pembahasan
                                                </Link>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Exam Type 1 (Grouped exam) -->
                            <div v-else>
                                <div v-if="!examGroup.exam.length" class="empty-sections">
                                    <i class="bx bx-file"></i>
                                    <p>Data Tidak Tersedia</p>
                                </div>
                                
                                <!-- Materi List -->
                                <div class="materi-section">
                                    <h6 class="materi-title">Materi Soal</h6>
                                    <div class="materi-grid">
                                        <div v-for="(exam, index) in examGroup.exam" :key="index" class="materi-item">
                                            <div class="materi-icon">
                                                <i class="bx bx-book"></i>
                                            </div>
                                            <div class="materi-content">
                                                <span class="materi-name">{{ exam.title }}</span>
                                                <Link v-if="examGroupUser && examGroupUser.is_finished == 1 && exam.show_answer_discussion == 1" 
                                                      :href="`/user/grades/${exam.grade[0].id}/questions`" 
                                                      class="materi-link">
                                                    <i class="bx bx-message-dots"></i>
                                                    Pembahasan
                                                </Link>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Duration & Status -->
                                <div class="exam-summary">
                                    <div class="summary-item">
                                        <div class="summary-icon">
                                            <i class="bx bx-time-five"></i>
                                        </div>
                                        <div class="summary-content">
                                            <span class="summary-label">Durasi</span>
                                            <span class="summary-value">{{ examGroup.duration }} Menit</span>
                                        </div>
                                    </div>
                                    <div class="summary-item">
                                        <div class="summary-icon">
                                            <i class="bx bx-stats"></i>
                                        </div>
                                        <div class="summary-content">
                                            <span class="summary-label">Status</span>
                                            <span class="summary-value">
                                                <span v-if="!examGroupUser" class="status-badge status-pending">Belum Mengerjakan</span>
                                                <span v-else-if="examGroupUser && examGroupUser.is_finished == 0" class="status-badge status-progress">Sedang Dikerjakan</span>
                                                <span v-else-if="examGroupUser && examGroupUser.is_finished == 1" class="status-badge status-done">Sudah Selesai</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>


                                <!-- Action Buttons -->
                                <div class="grouped-actions">
                                    <span class="action-badge action-inactive" v-if="examGroup.exam_status == 'inprogress'">
                                        <i class="bx bx-loader-circle bx-spin"></i>
                                        Ujian In Progress
                                    </span>
                                    <span class="action-badge action-inactive" v-else-if="examGroup.exam_status == 'inactive'">
                                        <i class="bx bx-x-circle"></i>
                                        Ujian Tidak Aktif
                                    </span>
                                    <div v-else-if="examGroup.exam_status == 'active'" class="action-buttons-row">
                                        <div v-if="!examGroupUser">
                                            <Link :href="`/user/exam-groups/${examGroup.id}/exam-start`" class="btn-action-lg btn-start">
                                                <i class="bx bx-play-circle"></i>
                                                Mulai Kerjakan
                                            </Link>
                                        </div>
                                        <div v-else-if="examGroupUser && examGroupUser.is_finished == 0">
                                            <Link :href="`/user/exam-groups/${examGroup.id}/exam-start`" class="btn-action-lg btn-continue">
                                                <i class="bx bx-right-arrow-alt"></i>
                                                Lanjut Mengerjakan
                                            </Link>
                                        </div>
                                        <div v-else-if="examGroupUser && examGroupUser.is_finished == 1" class="done-actions-row">
                                            <a href="#" @click.prevent="repeatExamGroup(examGroup.id)" class="btn-action-lg btn-repeat" v-if="examGroup.repeat_the_exam == 1">
                                                <i class="bx bx-refresh"></i>
                                                Tes Ulang
                                            </a>
                                            <Link :href="`/user/exam-groups/histories/${examGroupUser.id}`" class="btn-action-lg btn-result">
                                                <i class="bx bx-bar-chart-alt-2"></i>
                                                Lihat Hasil
                                            </Link>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end page wrapper -->
</template>

<script>
import LayoutAdmin from '../../../../Layouts/Layout.vue';
import { Link } from '@inertiajs/inertia-vue3';
import { Head } from '@inertiajs/inertia-vue3';
import { ref } from 'vue';
import Swal from 'sweetalert2';
import { Inertia } from '@inertiajs/inertia';

export default {
    layout: LayoutAdmin,
    components: {
        Link,
        Head,
    },
    props: {
        examGroup: Object,
        lessonCategory: Object,
        examGroupUser: Object,
    },
    setup(props) {
        const collapseTryOutGroupInformation = ref(localStorage.getItem('collapseTryOutGroupInformation') !== null ? JSON.parse(localStorage.getItem('collapseTryOutGroupInformation')) : true);
        const collapseTryOutGroupDescription = ref(localStorage.getItem('collapseTryOutGroupDescription') !== null ? JSON.parse(localStorage.getItem('collapseTryOutGroupDescription')) : true);
        const collapseTryOutGroupExam = ref(localStorage.getItem('collapseTryOutGroupExam') !== null ? JSON.parse(localStorage.getItem('collapseTryOutGroupExam')) : true);

        const repeatExam = (id) => {
            Swal.fire({
                title: 'Konfirmasi Ulangi Pengerjaan',
                text: "Mengulangi Ujian Dapat Mempengaruhi Nilai Anda.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#1477F5',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ulangi Ujian'
            })
            .then((result) => {
                if (result.isConfirmed) {
                    Inertia.get(`/user/exams/${id}/exam-start?repeat=1`);
                    Swal.fire({
                        title: 'Success!',
                        text: 'Silakan Untuk Mengerjakan Kembali.',
                        icon: 'success',
                        timer: 1000,
                        showConfirmButton: false,
                    });
                }
            })
        }

        const repeatExamGroup = (id) => {
            Swal.fire({
                title: 'Konfirmasi Ulangi Pengerjaan',
                text: "Mengulangi Ujian Dapat Mempengaruhi Nilai Anda.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#1477F5',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ulangi Ujian'
            })
            .then((result) => {
                if (result.isConfirmed) {
                    Inertia.get(`/user/exam-groups/${id}/exam-start?repeat=1`);
                    Swal.fire({
                        title: 'Success!',
                        text: 'Silakan Untuk Mengerjakan Kembali.',
                        icon: 'success',
                        timer: 1000,
                        showConfirmButton: false,
                    });
                }
            })
        }

        // Calculate answered questions for individual exam
        const getAnsweredCount = (exam) => {
            if (!exam.grade || !exam.grade[0]) return 0;
            return exam.grade[0].total_correct + exam.grade[0].total_incorrect || 0;
        }

        const getTotalQuestions = (exam) => {
            if (!exam.question_title) return 0;
            return exam.question_title.total_question || 0;
        }

        const getUnansweredCount = (exam) => {
            return getTotalQuestions(exam) - getAnsweredCount(exam);
        }

        const getProgressPercentage = (exam) => {
            const total = getTotalQuestions(exam);
            if (total === 0) return 0;
            return Math.round((getAnsweredCount(exam) / total) * 100);
        }

        // Calculate for grouped exam
        const getGroupAnsweredCount = () => {
            if (!props.examGroupUser) return 0;
            let total = 0;
            props.examGroup.exam.forEach(exam => {
                if (exam.grade && exam.grade[0]) {
                    total += (exam.grade[0].total_correct + exam.grade[0].total_incorrect) || 0;
                }
            });
            return total;
        }

        const getGroupTotalQuestions = () => {
            let total = 0;
            props.examGroup.exam.forEach(exam => {
                if (exam.question_title) {
                    total += exam.question_title.total_question || 0;
                }
            });
            return total;
        }

        const getGroupProgressPercentage = () => {
            const total = getGroupTotalQuestions();
            if (total === 0) return 0;
            return Math.round((getGroupAnsweredCount() / total) * 100);
        }

        return {
            repeatExam,
            repeatExamGroup,
            collapseTryOutGroupInformation,
            collapseTryOutGroupDescription,
            collapseTryOutGroupExam,
            getAnsweredCount,
            getTotalQuestions,
            getUnansweredCount,
            getProgressPercentage,
            getGroupAnsweredCount,
            getGroupTotalQuestions,
            getGroupProgressPercentage
        }
    }
}
</script>

<style scoped>
/* Header */
.section-header { margin-bottom: 2rem; }

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
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 1rem;
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
    margin: 0.5rem 0 0;
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
}

.badge-category, .badge-lesson {
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 500;
}

.badge-category {
    background: rgba(248, 198, 44, 0.3);
    color: #F8C62C;
}

.badge-lesson {
    background: rgba(255, 255, 255, 0.2);
    color: #fff;
}

.history-btn {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1.25rem;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 12px;
    color: #fff;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
}

.history-btn:hover {
    background: rgba(255, 255, 255, 0.3);
    color: #fff;
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

/* Info Cards */
.info-card {
    background: #fff;
    border-radius: 20px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    overflow: hidden;
    height: 100%;
}

.card-header-modern {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1.25rem;
    border-bottom: 1px solid #f3f4f6;
}

.header-icon {
    width: 45px;
    height: 45px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
    color: #fff;
}

.bg-gradient-blue { background: linear-gradient(135deg, #1477F5, #0d5cbf); }
.bg-gradient-yellow { background: linear-gradient(135deg, #F8C62C, #e5b526); }

.card-title-modern {
    margin: 0;
    font-weight: 600;
    color: #1f2937;
}

.card-body-modern {
    padding: 1.5rem;
}

/* Participant Card */
.participant-avatar {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #1477F5, #0d5cbf);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1rem;
}

.avatar-text {
    color: #fff;
    font-size: 2rem;
    font-weight: 700;
}

.participant-name {
    text-align: center;
    color: #1f2937;
    font-weight: 600;
    margin-bottom: 0.25rem;
}

.participant-email {
    text-align: center;
    color: #6b7280;
    font-size: 0.9rem;
    margin-bottom: 1.5rem;
}

.info-list {
    border-top: 1px solid #f3f4f6;
    padding-top: 1rem;
}

.info-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.75rem 0;
    border-bottom: 1px dashed #f3f4f6;
}

.info-label {
    color: #6b7280;
    font-size: 0.9rem;
}

.badge-primary {
    background: linear-gradient(135deg, #1477F5, #0d5cbf);
    color: #fff;
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 500;
}

.badge-success {
    background: linear-gradient(135deg, #10b981, #059669);
    color: #fff;
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 500;
}

/* Sections List */
.sections-list {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.section-item {
    display: flex;
    gap: 1rem;
    padding: 1.25rem;
    background: #f9fafb;
    border-radius: 16px;
    transition: all 0.3s ease;
}

.section-item:hover {
    background: #f3f4f6;
}

.section-number {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, #1477F5, #0d5cbf);
    color: #fff;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    flex-shrink: 0;
}

.section-content {
    flex: 1;
}

.section-title {
    color: #1f2937;
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.section-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
    margin-bottom: 0.75rem;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 0.25rem;
    color: #6b7280;
    font-size: 0.85rem;
}

/* Question Progress */
.question-progress, .question-progress-group {
    background: #fff;
    border-radius: 12px;
    padding: 1rem;
    margin-bottom: 1rem;
    border: 1px solid #e5e7eb;
}

.progress-label, .progress-header {
    display: flex;
    justify-content: space-between;
    margin-bottom: 0.5rem;
    font-size: 0.85rem;
    color: #374151;
}

.progress-value {
    font-weight: 600;
    color: #1477F5;
}

.progress-bar-wrapper {
    height: 8px;
    background: #e5e7eb;
    border-radius: 4px;
    overflow: hidden;
    margin-bottom: 0.75rem;
}

.progress-bar-fill {
    height: 100%;
    background: linear-gradient(90deg, #1477F5, #F8C62C);
    border-radius: 4px;
    transition: width 0.5s ease;
}

.progress-stats {
    display: flex;
    gap: 1.5rem;
    font-size: 0.8rem;
}

.stat-answered {
    color: #10b981;
    display: flex;
    align-items: center;
    gap: 0.25rem;
}

.stat-unanswered {
    color: #ef4444;
    display: flex;
    align-items: center;
    gap: 0.25rem;
}

/* Status Badges */
.section-status {
    margin-bottom: 0.5rem;
}

.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.25rem;
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 500;
}

.status-pending {
    background: #fee2e2;
    color: #dc2626;
}

.status-progress {
    background: #fef3c7;
    color: #d97706;
}

.status-done {
    background: #d1fae5;
    color: #059669;
}

/* Section Actions */
.section-actions {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
    min-width: 120px;
}

.action-badge {
    display: flex;
    align-items: center;
    gap: 0.25rem;
    padding: 0.5rem 1rem;
    border-radius: 8px;
    font-size: 0.8rem;
    font-weight: 500;
}

.action-inactive {
    background: #f3f4f6;
    color: #6b7280;
}

.btn-action {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.25rem;
    padding: 0.5rem 1rem;
    border-radius: 8px;
    font-size: 0.8rem;
    font-weight: 600;
    text-decoration: none;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-start {
    background: linear-gradient(135deg, #1477F5, #0d5cbf);
    color: #fff;
}

.btn-continue {
    background: linear-gradient(135deg, #F8C62C, #e5b526);
    color: #1f2937;
}

.btn-repeat {
    background: linear-gradient(135deg, #6b7280, #4b5563);
    color: #fff;
}

.btn-result {
    background: linear-gradient(135deg, #10b981, #059669);
    color: #fff;
}

.btn-discuss {
    background: linear-gradient(135deg, #8b5cf6, #7c3aed);
    color: #fff;
}

.btn-action:hover {
    transform: translateY(-2px);
    opacity: 0.9;
}

.done-actions {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

/* Large Action Buttons */
.btn-action-lg {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    padding: 1rem 2rem;
    border-radius: 12px;
    font-size: 1rem;
    font-weight: 600;
    text-decoration: none;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-action-lg:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
}

.action-buttons-row {
    display: flex;
    justify-content: center;
}

.done-actions-row {
    display: flex;
    gap: 1rem;
    justify-content: center;
    flex-wrap: wrap;
}

/* Materi Section */
.materi-section {
    margin-bottom: 1.5rem;
}

.materi-title {
    color: #374151;
    margin-bottom: 1rem;
}

.materi-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
}

.materi-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem;
    background: #f9fafb;
    border-radius: 12px;
}

.materi-icon {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, #1477F5, #0d5cbf);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
}

.materi-content {
    flex: 1;
}

.materi-name {
    display: block;
    color: #374151;
    font-weight: 500;
    margin-bottom: 0.25rem;
}

.materi-link {
    display: inline-flex;
    align-items: center;
    gap: 0.25rem;
    color: #8b5cf6;
    font-size: 0.8rem;
    text-decoration: none;
}

.materi-link:hover {
    color: #7c3aed;
}

/* Exam Summary */
.exam-summary {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.summary-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem;
    background: #f9fafb;
    border-radius: 12px;
}

.summary-icon {
    width: 45px;
    height: 45px;
    background: linear-gradient(135deg, #F8C62C, #e5b526);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #1f2937;
    font-size: 1.25rem;
}

.summary-content {
    display: flex;
    flex-direction: column;
}

.summary-label {
    color: #6b7280;
    font-size: 0.8rem;
}

.summary-value {
    color: #1f2937;
    font-weight: 600;
}

/* Grouped Actions */
.grouped-actions {
    display: flex;
    justify-content: center;
    padding-top: 1rem;
}

/* Empty State */
.empty-sections {
    text-align: center;
    padding: 2rem;
    color: #9ca3af;
}

.empty-sections i {
    font-size: 3rem;
    margin-bottom: 1rem;
}

/* Alert Modern */
.alert-modern {
    display: flex;
    align-items: flex-start;
    border-radius: 12px;
    padding: 1rem 1.5rem;
}

.alert-modern i {
    font-size: 1.25rem;
    flex-shrink: 0;
}

/* Responsive */
@media (max-width: 768px) {
    .header-content {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .section-item {
        flex-direction: column;
    }
    
    .section-actions {
        width: 100%;
    }
    
    .done-actions-row {
        flex-direction: column;
    }
}
</style>
