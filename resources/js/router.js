import Comments from './components/Comment/ListCommentsComponent'

export default {
    mode: 'history',
    routes: [
        {
            path: '/comments',
            name: 'comments',
            component: Comments
        }
    ],
};
