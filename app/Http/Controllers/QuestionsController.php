<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestionRequest;
use App\Repositories\QuestionRepository;
use Auth;
use Illuminate\Http\Request;

/**
 * Class QuestionsController
 * @package App\Http\Controllers
 */
class QuestionsController extends Controller
{
    /**
     * @var QuestionRepository
     */
    protected $questionRepository;

    /**
     * QuestionsController constructor.
     * @param QuestionRepository $questionRepository
     */
    public function __construct(QuestionRepository $questionRepository)
    {
        $this->middleware('auth')->except(['index', 'show']);
        $this->questionRepository = $questionRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = $this->questionRepository->getQuestionsFeed();
        return view('questions.index', ['questions' => $questions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('questions.create');
    }

    /**
     * @param StoreQuestionRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreQuestionRequest $request)
    {
        $topics = $this->questionRepository->normalizeTopic($request->get('topics'));
        $data = [
            'title' => $request->get('title'),
            'body' => $request->get('body'),
            'user_id' => Auth::id()
        ];
        $question = $this->questionRepository->create($data);
        $question->topic()->attach($topics);
        return redirect()->route('questions.show', [$question->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $question = $this->questionRepository->bgIdWithTopicsAndAnswers($id);
        return view('questions.show', ['question' => $question]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question = $this->questionRepository->byId($id);
        if (Auth::user()->owns($question)) {
            return view('questions.edit', ['question' => $question]);
        }
        return back();
    }


    /**
     * @param StoreQuestionRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @author zhangpengyi
     */
    public function update(StoreQuestionRequest $request, $id)
    {
        $topics = $this->questionRepository->normalizeTopic($request->get('topics'));
        $question = $this->questionRepository->byId($id);
        $question->update([
            'title' => $request->get('title'),
            'body' => $request->get('body')
        ]);
        $question->topic()->sync($topics);
        return redirect()->route('questions.show', [$question->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @author zhangpengyi
     */
    public function destroy($id)
    {
        //
        $question = $this->questionRepository->byId($id);
        if (Auth::user()->owns($question)) {
            $question->delete();
            return redirect(route('questions.index'));
        }
        return back();
    }
}
