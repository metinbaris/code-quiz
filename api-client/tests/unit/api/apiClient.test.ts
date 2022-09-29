import apiClient from "../../../src/api/apiClient";
import * as dotenv from "dotenv"
dotenv.config()

describe('API Client headers', () => {
    it('Should have a content type of application/json', () => {
        const headers = apiClient.axiosClient.defaults.headers;
        expect(headers['Content-Type']).toEqual('application/json')
    })
    it('Should have a accept header with the value application/json', () => {
        const headers = apiClient.axiosClient.defaults.headers;
        expect(headers['Accept']).toEqual('application/json')
    })
})
describe('API Client options', () => {
    it('Should have the base url of ' + process.env.API_BASE_PATH, () => {
        const baseURL = apiClient.axiosClient.defaults.baseURL;
        expect(baseURL).toEqual(process.env.API_BASE_PATH)
    })
})