            <!-- Comments -->
            <div>
                <h2 class="tm-color-primary tm-post-title">Comments</h2>
                <hr class="tm-hr-primary tm-mb-45">
                @foreach($comments as $comment)
                @if($comment->post_id == $post->id)
                <div class="tm-comment" style="background-color: #f3f0f0;border-radius: 8px;padding: 8px; height: fit-content;margin-bottom: 18px;">
                    <div style="width: 130px;">
                        <div style="display: flex;justify-content: center;align-items: center;flex-direction: column;padding: 2px;">
                            @if($comment->user->avatar == null)
                            <img width="40" height="40" src="{{ asset('storage/uploads/avatardefault.jpg') }}" alt="User profile picture" style="border-radius: 50%;">
                            @else
                            <img width="40" height="40" src="{{ asset('storage/uploads/'.$comment->user->avatar) }}" alt="{{$comment->user->name}}" style="border-radius: 50%;">

                            @endif
                            <p class="tm-color-primary text-center" style="font-size: 12px;margin-bottom: 0;">{{$comment->user->name}}</p>
                        </div>
                    </div>
                    <div style="margin-left: 24px;">
                        <div class="d-flex justify-content-between">
                            <!-- <a href="#" class="tm-color-primary">REPLY</a> -->
                            <div>
                                <span class="tm-color-primary " style="font-size: 12px;">Time: {{$comment->created_at}}</span>
                            </div>
                        </div>
                        <p style="color: black; font-size: 15px;">
                            {{ $comment->content }}
                        </p>
                    </div>
                </div>
                @endif
                @endforeach

                <form action="{{route('blog.comment')}}" class="mb-5 tm-comment-form" method="get">
                    <h2 class="tm-color-primary tm-post-title mb-4">Your comment</h2>
                    <div class="mb-4">
                        <textarea class="form-control" name="content" rows="6" style="width: 600px;"></textarea>
                    </div>
                    <input type="text" name="post_id" hidden value="{{$post->id}}">
                    <div class="text-right">
                        <button class="tm-btn tm-btn-primary tm-btn-small">Submit</button>
                    </div>
                    @csrf
                </form>
            </div>
