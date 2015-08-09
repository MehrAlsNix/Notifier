<?php
/**
 * Notifier
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 *
 * @copyright 2015 MehrAlsNix (http://www.mehralsnix.de)
 * @license   http://www.opensource.org/licenses/mit-license.php MIT
 * @link      http://github.com/MehrAlsNix/Notifier
 */

namespace MehrAlsNix\Notifier;

/**
 * Class Notification
 * @package MehrAlsNix\Notifier
 */
abstract class Notification
{
    /**
     * An error occurred.
     * @param string $msg
     */
    public function addMessage($title, $msg)
    {
        $this->notify($title, $msg);
    }

    /**
     * Notify.
     *
     * @param string $title
     * @param string $message
     *
     * @return mixed
     */
    abstract protected function notify($title, $message);

    /**
     * @param string $command
     * @return array|null
     */
    protected function execute($command)
    {
        $status = null;
        $result = [];
        exec($command, $result, $status);
        return !$status ? $result : null;
    }
}
