<?php

namespace App\Http\Controllers\Web;

use App\Exceptions\AlreadyInTeamException;
use App\Exceptions\AlreadyInTeamInvitedUserException;
use App\Exceptions\AlreadyInvitedException;
use App\Exceptions\SlackInviteFailException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Slack\InviteRequest;
use App\Services\Slack\Inviter;
use Illuminate\Http\Request;

class SlackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.slack.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  InviteRequest  $request
     * @param  Inviter  $inviter
     * @return \Illuminate\Http\Response
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function store(InviteRequest $request, Inviter $inviter)
    {
        try {
            $inviter->invite($request->get('email'));

            toastr()->success('초대장이 신청하신 메일로 발송되었습니다.');
        } catch (AlreadyInvitedException|AlreadyInTeamException|AlreadyInTeamInvitedUserException $exception) { // 이메일 무작위 대입 후 에러핸들링을 통해 멤버 이메일 확인방지

            toastr()->warning('이미 초대장이 발송완료되었습니다. 초대장을 받지 못하셨다면 스팸메일함을 확인해보시거나 모던퍼그 페이스북을 통해 문의해주세요.');
        } catch (SlackInviteFailException $exception) {
            \Sentry::captureException($exception);
            $request->flash();

            toastr()->error('초대장 발송이 실패했습니다. 계속해서 발송이 실패하는 경우 모던퍼그 페이스북을 통해 문의해주세요');
        }

        return redirect(route('slack.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
