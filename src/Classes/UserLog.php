<?php

	namespace Multimedia\Multistore\Classes;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Multimedia\Multistore\Core\Models\UserLog as ModelsUserLog;
    use Jenssegers\Agent\Facades\Agent;

	class UserLog {
        public function register($module, $id_record, $params) {

            $params["ip"] = \Request::ip();
            $params["browser"] = [
                "name" => Agent::browser(),
                "version" => Agent::version(Agent::browser()),
            ];
            $params["platform"] = Agent::platform();
            $params["device"] = [
                "desktop" => Agent::isDesktop(),
                "tablet" => Agent::isTablet(),
                "phone" => Agent::isPhone()
            ];

            ModelsUserLog::create([
                'id_user' => isset(Auth::user()->id_user) ? Auth::user()->id_user : null,
                'module' => $module,
                'id_record' => $id_record,
                'params' => $params,
                'changes' => []
            ]);
        }
	}
