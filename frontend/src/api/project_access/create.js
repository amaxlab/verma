import client from '@/api/client';

export default data => new Promise ((resolve, reject) => {
    client.post('/api/project_accesses', data).then(project_access => {
        resolve(project_access);
    }).catch(error => {
        reject(error);
    });
});
