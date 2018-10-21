import create from './create';
import get from './get';
import getAll from './getAll';
import deleteApi from './delete';
import update from './update';
import setEnabled from './setEnabled';

const user = {
    create: create,
    get: get,
    getAll: getAll,
    delete: deleteApi,
    update: update,
    setEnabled: setEnabled
};

export default user;
