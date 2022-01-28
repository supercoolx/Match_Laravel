@if(isset($profile->skills))
    @php
        $skill_os = []; $skill_pro = []; $skill_frame = []; $skill_db = []; $skill_infra = []; $skill_tool = []; $skill_other = [];
        foreach($profile->skills as $exp) {
            switch ($exp->type) {
                case 'os':
                    $skill_os[] = $exp;
                    break;
                case 'pro':
                    $skill_pro[] = $exp;
                    break;
                case 'frame':
                    $skill_frame[] = $exp;
                    break;
                case 'db':
                    $skill_db[] = $exp;
                    break;
                case 'infra':
                    $skill_infra[] = $exp;
                    break;
                case 'tool':
                    $skill_tool[] = $exp;
                    break;
                default:
                    $skill_other[$exp->type][] = $exp;
                    break;
            }
        }
    @endphp
    <div class="row">
        <div class="col-md-6">
            <div class="item">
                <div class="item-header" data-toggle="collapse" data-target="#experience-os">
                    <i class="fas fa-caret-down"></i>OS
                </div>
                <div id="experience-os" class="collapse show">
                    @foreach($skill_os as $exp)
                        <div class="row">
                            <div class="col-md-6">{{ $exp->name }}</div>
                            <div class="col-md-6">{{ $exp->year }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="item">
                <div class="item-header" data-toggle="collapse" data-target="#experience-pro">
                    <i class="fas fa-caret-down"></i>プログラミング言語
                </div>
                <div id="experience-pro" class="collapse show">
                    @foreach($skill_pro as $exp)
                        <div class="row">
                            <div class="col-md-6">{{ $exp->name }}</div>
                            <div class="col-md-6">{{ $exp->year }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="item">
                <div class="item-header" data-toggle="collapse" data-target="#experience-frame">
                    <i class="fas fa-caret-down"></i>フレームワーク
                </div>
                <div id="experience-frame" class="collapse show">
                    @foreach($skill_frame as $exp)
                        <div class="row">
                            <div class="col-md-6">{{ $exp->name }}</div>
                            <div class="col-md-6">{{ $exp->year }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="item">
                <div class="item-header" data-toggle="collapse" data-target="#experience-db">
                    <i class="fas fa-caret-down"></i>インフラ
                </div>
                <div id="experience-db" class="collapse show">
                    @foreach($skill_db as $exp)
                        <div class="row">
                            <div class="col-md-6">{{ $exp->name }}</div>
                            <div class="col-md-6">{{ $exp->year }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="item">
                <div class="item-header" data-toggle="collapse" data-target="#experience-infra">
                    <i class="fas fa-caret-down"></i>データベース
                </div>
                <div id="experience-infra" class="collapse show">
                    @foreach($skill_infra as $exp)
                        <div class="row">
                            <div class="col-md-6">{{ $exp->name }}</div>
                            <div class="col-md-6">{{ $exp->year }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="item">
                <div class="item-header" data-toggle="collapse" data-target="#experience-tool">
                    <i class="fas fa-caret-down"></i>その他ツール
                </div>
                <div id="experience-tool" class="collapse show">
                    @foreach($skill_tool as $exp)
                        <div class="row">
                            <div class="col-md-6">{{ $exp->name }}</div>
                            <div class="col-md-6">{{ $exp->year }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6" id="experience-other">
            @foreach($skill_other as $type => $skill)
                <div class="item">
                    <div class="item-header" data-toggle="collapse" data-target="#experience-{{$skill[0]->id}}">
                        <i class="fas fa-caret-down"></i>{{ $type }}
                    </div>
                    <div id="experience-{{$skill[0]->id}}" class="collapse show">
                        @foreach($skill as $exp)
                            <div class="row">
                                <div class="col-md-6">{{ $exp->name }}</div>
                                <div class="col-md-6">{{ $exp->year }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif