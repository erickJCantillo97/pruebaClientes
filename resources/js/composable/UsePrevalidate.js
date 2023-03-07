import {watch} from 'vue'
import { router } from '@inertiajs/vue3'

export function usePreValidate(form, {method, url}){

    let touchedFields = new Set();
    let needsValidation = false;

     watch(() => form.data(), (newData, oldData) => {
        let changedFields = Object.keys(newData).filter(field => newData[field] !== oldData[field]);
        touchedFields = new Set([...changedFields, ...touchedFields])
        needsValidation = true;
      }) 
      
      function validate() {
        
        if(!needsValidation) return;
  
        needsValidation = false;
        
        router.visit(url, {
          method: method,
          data: {
            ...form.data(),
            prevalidate: true
          },
          preserveState: true,
          preserveScroll: true,
          onError: (errors) => {
              Object.keys(errors)
              .filter(field  => !touchedFields.has(field))
              .forEach(field => delete errors[field]);
  
              form.clearErrors().setError(errors)
          },
          onSuccess: () => {
              form.clearErrors()
          }
  
        })
    }
    return {validate};
}