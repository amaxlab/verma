import create from './create';
import get from './get';
import deleteApi from './delete';
import update from './update';

const project_access = {
    create: create,
    get: get,
    delete: deleteApi,
    update: update,
};

export default project_access;
