@extends('layouts.app')

@section('content')
    <div class="filter-tabs">
        <button class="filter-tab active">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            New
        </button>
        <button class="filter-tab">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M18 20V10M12 20V4M6 20v-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Top
        </button>
        <button class="filter-tab">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 2v8M12 18v4M4.93 10.93l1.41 1.41M17.66 11.66l1.41 1.41M2 18h20M4 21h16" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Hot
        </button>
        <button class="filter-tab">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="3" y="11" width="18" height="11" rx="2" ry="2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M7 11V7a5 5 0 0110 0v4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Closed
        </button>
    </div>

    {{-- <div class="posts-container">
        <!-- Post 1 -->
        <div class="post-card">
            <div class="post-header">
                <img src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fimages.pexels.com%2Fphotos%2F415829%2Fpexels-photo-415829.jpeg%3Fcs%3Dsrgb%26dl%3Dpexels-pixabay-415829.jpg%26fm%3Djpg&f=1&nofb=1&ipt=6bb6c718a326265b08848d32b233878885394328a82d1f98ec1e672e94352e14" alt="User avatar" class="avatar">
                <div>
                    <strong>Linuxoid</strong><br>
                    <small>25 min ago</small>
                </div>
            </div>
            <div class="post-body">
                <p><strong>What is a difference between Java nad JavaScript?</strong></p>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Bibendum vitae etiam lectus amet enim.</p>
            </div>
            <div class="post-tags">
                <span class="tag">java</span>
                <span class="tag">javascript</span>
                <span class="tag">wtf</span>
            </div>
            <div class="post-footer">
                <span>👁️ 125</span>
                <span>💬 15</span>
                <span>⬆️ 155</span>
            </div>
        </div>
    
        <!-- Post 2 -->
        <div class="post-card">
            <div class="post-header">
                <img src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fimages.pexels.com%2Fphotos%2F415829%2Fpexels-photo-415829.jpeg%3Fcs%3Dsrgb%26dl%3Dpexels-pixabay-415829.jpg%26fm%3Djpg&f=1&nofb=1&ipt=6bb6c718a326265b08848d32b233878885394328a82d1f98ec1e672e94352e14" alt="User avatar" class="avatar">
                <div>
                    <strong>CodeMaster</strong><br>
                    <small>1 hour ago</small>
                </div>
            </div>
            <div class="post-body">
                <p><strong>Why do developers hate CSS?</strong></p>
                <p>Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
            </div>
            <div class="post-tags">
                <span class="tag">css</span>
                <span class="tag">frontend</span>
            </div>
            <div class="post-footer">
                <span>👁️ 98</span>
                <span>💬 8</span>
                <span>⬆️ 43</span>
            </div>
        </div>
    
    
    </div> --}}
    <style>
        .posts-container {
            display: flex;
            flex-direction: column;
            gap: 20px;
            max-width: 600px;
            margin: 0 auto;
            font-family: Arial, sans-serif;
        }
    
        .post-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
            padding: 16px;
        }
    
        .post-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
        }
    
        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }
    
        .post-body p:first-child {
            font-weight: bold;
            margin-bottom: 5px;
        }
    
        .post-tags {
            margin: 10px 0;
        }
    
        .tag {
            display: inline-block;
            background: #eee;
            border-radius: 5px;
            padding: 4px 8px;
            font-size: 12px;
            margin-right: 6px;
        }
    
        .post-footer {
            display: flex;
            gap: 15px;
            font-size: 14px;
            color: #555;
        }
    </style>
    
    <div class="posts-container">
        <!-- Post 1 -->
        <div class="post-card">
            <div class="post-header">
                <img src="https://i.pravatar.cc/40?img=1" alt="User avatar" class="avatar">
                <div>
                    <strong>Linuxoid</strong><br>
                    <small>25 min ago</small>
                </div>
            </div>
            <div class="post-body">
                <p>What is a difference between Java nad JavaScript?</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Bibendum vitae etiam lectus amet enim.</p>
            </div>
            <div class="post-tags">
                <span class="tag">java</span>
                <span class="tag">javascript</span>
                <span class="tag">wtf</span>
            </div>
            <div class="post-footer">
                <span>👁️ 125</span>
                <span>💬 15</span>
                <span>⬆️ 155</span>
            </div>
        </div>
    
        <!-- Post 2 -->
        <div class="post-card">
            <div class="post-header">
                <img src="https://i.pravatar.cc/40?img=2" alt="User avatar" class="avatar">
                <div>
                    <strong>DevQueen</strong><br>
                    <small>2 hours ago</small>
                </div>
            </div>
            <div class="post-body">
                <p>React vs Vue: which one should I learn first?</p>
                <p>Quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            </div>
            <div class="post-tags">
                <span class="tag">react</span>
                <span class="tag">vue</span>
                <span class="tag">javascript</span>
            </div>
            <div class="post-footer">
                <span>👁️ 212</span>
                <span>💬 31</span>
                <span>⬆️ 199</span>
            </div>
        </div>
    </div>
    
    
@endsection
