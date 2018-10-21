import client from '@/api/client';

export default id => new Promise ((resolve, reject) => {
    client.delete('/api/project_accesses/'+id).then(project_access => {
        resolve(project_access);
    }).catch(error => {
        reject(error);
    });
});
