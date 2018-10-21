import client from '@/api/client';

export default (id, {user, project, project_access}) => new Promise ((resolve, reject) => {
    client.put('/api/project_accesses/'+id, {user: user, project: project, project_access: project_access}).then(project_access => {
        resolve(project_access);
    }).catch(error => {
        reject(error);
    });
});
