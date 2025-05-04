document.addEventListener('DOMContentLoaded', function() {
    // Sample post data
    const posts = [
        {
            id: 1,
            avatar: 'https://c.animaapp.com/ma9oji5g9IT5wA/img/ava.png',
            username: 'Golanginya',
            timeAgo: '5 min ago',
            title: 'How to patch KDE on FreeBSD?',
            content: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Consequat aliquet maecenas ut sit nulla',
            tags: ['golang', 'linux', 'overflow'],
            views: 125,
            comments: 15,
            upvotes: 155
        },
        {
            id: 2,
            avatar: 'https://c.animaapp.com/ma9oji5g9IT5wA/img/ava-1.png',
            username: 'Linuxoid',
            timeAgo: '25 min ago',
            title: 'What is a difference between Java and JavaScript?',
            content: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Bibendum vitae etiam lectus amet enim.',
            tags: ['java', 'javascript', 'wtf'],
            views: 125,
            comments: 15,
            upvotes: 155
        },
        // Add more posts as needed
    ];

    const postsContainer = document.querySelector('.posts-container');

    // Function to create a post element
    function createPostElement(post) {
        const postElement = document.createElement('div');
        postElement.className = 'post';
        postElement.innerHTML = `
            <div class="post-header">
                <img src="${post.avatar}" alt="${post.username}" class="avatar">
                <div class="post-info">
                    <span class="username">${post.username}</span>
                    <span class="time-ago">${post.timeAgo}</span>
                </div>
                <button class="more-options">•••</button>
            </div>
            <h2 class="post-title">${post.title}</h2>
            <p class="post-content">${post.content}</p>
            <div class="post-tags">
                ${post.tags.map(tag => `<span class="tag">${tag}</span>`).join('')}
            </div>
            <div class="post-stats">
                <span class="views">${post.views} views</span>
                <span class="comments">${post.comments} comments</span>
                <span class="upvotes">${post.upvotes} upvotes</span>
            </div>
        `;
        return postElement;
    }

    // Render posts
    function renderPosts(postsToRender) {
        postsContainer.innerHTML = ''; // Clear existing posts
        postsToRender.forEach(post => {
            postsContainer.appendChild(createPostElement(post));
        });
    }

    // Initial render
    renderPosts(posts);

    // Filter tabs functionality
    const filterTabs = document.querySelectorAll('.filter-tab');
    filterTabs.forEach(tab => {
        tab.addEventListener('click', function() {
            filterTabs.forEach(t => t.classList.remove('active'));
            this.classList.add('active');
            
            // Here you would typically filter the posts based on the selected tab
            // For demonstration, we're just re-rendering all posts
            renderPosts(posts);
            
            console.log('Filter selected:', this.textContent);
        });
    });
});
