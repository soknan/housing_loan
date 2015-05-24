<?php

Event::listen(
    'user_action.*',
    function ($page, $detail = 'default') {
        // Check event type
        $event = '';
        switch (Event::firing()) {
            case 'user_action.add':
                $event = 'add';
                break;
            case 'user_action.edit':
                $event = 'edit';
                break;
            case 'user_action.delete':
                $event = 'delete';
                break;
            case 'user_action.report':
                $event = 'report';
                break;
            case 'user_action.backup':
                $event = 'backup';
                break;
            case 'user_action.restore':
                $event = 'restore';
                break;
        }

        $queries = DB::getQueryLog();
        $sql = end($queries);

        if( ! empty($sql['bindings']))
        {
            $pdo = DB::getPdo();
            foreach($sql['bindings'] as $binding)
            {
                $sql['query'] =
                    preg_replace('/\?/', $pdo->quote($binding),
                        $sql['query'], 1);
            }
        }

        //return $sql['query'];

        $data = new \Battambang\Cpanel\UserActionModel();
        $data->cp_user_id = Auth::user()->id;
        $data->event = $event;
        $data->page = $page;
        $data->detail = (($detail == 'default') ? $sql['query'].';' : $detail);
        $data->package_type = UserSession::read()->package;
        $data->cp_office_id = UserSession::read()->sub_branch;
        $data->save();
    }
);