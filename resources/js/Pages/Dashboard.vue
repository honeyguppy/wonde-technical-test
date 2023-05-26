<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Employee from '@/types/Employee';
import Class from '@/types/Class';
import Lesson from '@/types/Lesson';
import CustomError from '@/types/CustomError.js';
import { Head, router } from '@inertiajs/vue3';
import { ref } from 'vue';
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'

const props = defineProps<{
    employees: Employee[];
    classData: Class[];
    lessons: Lesson[];
    selectedEmployeeId: string;
    selectedDate: string;
    errors: CustomError;
}>();

const date = ref(new Date(props.selectedDate));
const selectedEmployee = ref(props.selectedEmployeeId);

const getClassDataById = (classId: string | null): Class | undefined => {
    return props.classData.find((classItem) => classItem.id === classId);
}

const formatTime = (timeStamp: string): string => {
    return new Date(timeStamp).toLocaleTimeString([], { hour: 'numeric', minute: 'numeric' });
}

const formatDatepicker = (date: Date) => {
    const day = date.getDate();
    const month = date.getMonth() + 1;
    const year = date.getFullYear();

    return `${day}/${month}/${year}`;
}

const handleDateChange = (modelData: Date) => {
    date.value = modelData;
    loadData();
}

const loadData = () => {
    const day = date.value.getDate();
    const month = date.value.getMonth() + 1;
    const year = date.value.getFullYear();

    router.visit(`/dashboard`, {
        only: ['lessons', 'classData', 'selectedEmployeeId', 'selectedDate', 'errors'],
        data: {
            employeeId: selectedEmployee.value,
            date: `${year}-${month}-${day}`
        }
    });
}
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex space-x-2">
                <div>
                    <select v-model="selectedEmployee" @change="loadData">
                        <option value="">Select an employee</option>
                        <option v-for="employee in employees" :value="employee.id" :key="employee.id">
                            {{ employee.forename }} {{ employee.surname }}
                        </option>
                    </select>
                    <div class="text-red-500 font-bold" v-if="errors.employeeId">{{ errors.employeeId }}</div>
                </div>
                <div>
                    <VueDatePicker 
                        v-model="date" 
                        :enable-time-picker="false" 
                        :format="formatDatepicker" 
                        @update:model-value="handleDateChange"
                        class="max-w-xs"
                    ></VueDatePicker>
                    <div class="text-red-500 font-bold" v-if="errors.date">{{ errors.date }}</div>
                </div>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-5">
                <div class="text-2xl text-gray-800">
                     {{ date.toDateString() }}
                </div>
                <div v-if="!lessons || lessons.length === 0" class="text-2xl text-gray-800">
                    No lessons found
                </div>
                <div v-for="lesson in lessons" :key="lesson.id" class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 flex justify-between">
                        <!-- Name of the teacher's class -->
                        <span>
                            {{ getClassDataById(lesson.class_id)?.name }} 
                        </span>
                        <span>
                            {{ formatTime(lesson.start_at) }} - {{ formatTime(lesson.end_at) }} 
                        </span>
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-5 gap-3 px-6 pb-6">
                        <div v-for="student in getClassDataById(lesson.class_id)?.students" class="inline-block outline outline-gray-500 text-gray-800 text-md px-2 py-1 rounded-md mr-2">
                            {{ student.forename }} {{ student.surname }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
