import {QuizJsonldRead} from "../../generated/openapi"

const PythonQuiz: QuizJsonldRead =
    {
        '@context': "/api/v1/contexts/Quiz",
        '@id': "/api/v1/quiz/3",
        '@type': "Quiz",
        title: "Python Quiz",
        slug: 'python-quiz',
        questions: [
            "/api/v1/question/5",
            "/api/v1/question/6",
            "/api/v1/question/7",
            "/api/v1/question/8",
            "/api/v1/question/9"
        ]
    }


export default PythonQuiz