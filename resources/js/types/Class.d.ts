import { Student } from "./Student";
import { Lesson } from "./Lesson";


interface Class {
    id: string;
    name: string;
    students: Student[] | null;
}

export default Class;
