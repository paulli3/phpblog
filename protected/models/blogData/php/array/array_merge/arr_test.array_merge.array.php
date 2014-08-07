<!--author:liyang-->
<!--author:liyang-->
<!--author:liyang-->
!!示例
初级应用， 演示了 各个回调
{erl}
%%% -------------------------------------------------------------------
%%% Author  : Administrator
%%% Description :
%%%
%%% Created : 2013-4-2
%%% -------------------------------------------------------------------
-module(talk).

-behaviour(gen_server).
%% --------------------------------------------------------------------
%% Include files
%% --------------------------------------------------------------------

%% --------------------------------------------------------------------
%% External exports
-export([start/0,sendmsg/1,stop/0]).

%% gen_server callbacks
-export([init/1, handle_call/3, handle_cast/2, handle_info/2, terminate/2, code_change/3]).

-record(state, {}).

%% ====================================================================
%% External functions
%% ====================================================================
start()->
	gen_server:start_link({local,talk},talk,[param],[]).%%启动的时候，回调了talk:init/1
sendmsg(Msg)->
  	io:format("client--- sendMsg server is ~p , Msg is ~p ........~n",[?MODULE,Msg]),
  	RevMsg = gen_server:call(?MODULE,{sendmsg,Msg}),%%调用call的时候，回调了module:handle_call/3
	io:format("-------------------~nclient receive server Msg ~p~n---------------------- ~n",[RevMsg]). 
stop()->
	io:format("client--- send stop........~n"),
	gen_server:call(?MODULE,{stop}).  %%返回stop的时候，回调了module:terminate/2

%% ====================================================================
%% Server functions
%% ====================================================================

%% --------------------------------------------------------------------
%% Function: init/1
%% Description: Initiates the server
%% Returns: {ok, State}          |
%%          {ok, State, Timeout} |
%%          ignore               |
%%          {stop, Reason}
%% --------------------------------------------------------------------
init([P]) ->
	io:format("server--- [~p] start! param is [~p] ~n",[?MODULE,P]),
    {ok, #state{}}.


%% --------------------------------------------------------------------
%% Function: handle_call/3
%% Description: Handling call messages
%% Returns: {reply, Reply, State}          |
%%          {reply, Reply, State, Timeout} |
%%          {noreply, State}               |
%%          {noreply, State, Timeout}      |
%%          {stop, Reason, Reply, State}   | (terminate/2 is called)
%%          {stop, Reason, State}            (terminate/2 is called)
%% --------------------------------------------------------------------
handle_call({sendmsg,Msg}, From, State) ->
	io:format("server--- [~p] receive msg From [~p] Msg is [~p] ~n",[?MODULE,From,Msg]),
    Reply = ok,
    {reply, Reply, State};
handle_call({stop}, From, State) ->
	io:format("server--- [~p] receive stop notice!~n",[?MODULE]),
    {stop, normal, stopped,State}.
	
%% --------------------------------------------------------------------
%% Function: handle_cast/2
%% Description: Handling cast messages
%% Returns: {noreply, State}          |
%%          {noreply, State, Timeout} |
%%          {stop, Reason, State}            (terminate/2 is called)
%% --------------------------------------------------------------------
handle_cast(Msg, State) ->
    {noreply, State}.

%% --------------------------------------------------------------------
%% Function: handle_info/2
%% Description: Handling all non call/cast messages
%% Returns: {noreply, State}          |
%%          {noreply, State, Timeout} |
%%          {stop, Reason, State}            (terminate/2 is called)
%% --------------------------------------------------------------------
handle_info(Info, State) ->
    {noreply, State}.

%% --------------------------------------------------------------------
%% Function: terminate/2
%% Description: Shutdown the server
%% Returns: any (ignored by gen_server)
%% --------------------------------------------------------------------
terminate(Reason, State) ->
	io:format("server--- [~p] stop !~n",[Reason]),
    ok.

%% --------------------------------------------------------------------
%% Func: code_change/3
%% Purpose: Convert process state when code is changed
%% Returns: {ok, NewState}
%% --------------------------------------------------------------------
code_change(OldVsn, State, Extra) ->
    {ok, State}.

%% --------------------------------------------------------------------
%%% Internal functions
%% --------------------------------------------------------------------
{/erl}
eshell 里面
{cerl}
(ss@localhost)1> talk:start().
server--- [talk] start! param is [param]

{ok,<0.39.0>}
(ss@localhost)2> talk:sendmsg("hohohahe99").
client--- sendMsg server is talk , Msg is "hohohahe99" ........

server--- [talk] receive msg From [{<0.37.0>,#Ref<0.0.0.38>}] Msg is ["hohohahe99"]

ok
(ss@localhost)3> talk:stop().
client--- send stop........

server--- [talk] receive stop notice!

server--- [normal] stop !stopped
(ss@localhost)4>
{/cerl}